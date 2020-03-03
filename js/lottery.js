angular.module('root')
    .controller("LotteryController", function ($scope, $rootScope, $controller, $timeout, LotteryFactory, CoreFactory) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            items: null,
            temp : null,
            prize: prize,
            spin: function () {
                window.wheel.spin();
                $timeout(function () {
                    LotteryFactory.spin().$promise.then(function (res) {
                        $scope.temp = res.data;
                        window.wheel.setPrize(res.data);
                    });
                }, 2000);
            },
            loginFB: function () {
                CoreFactory.fbLoginLink().$promise.then(function (res) {
                    if (res.data) {
                        location.href = res.data;
                    }
                });
            }
        });

        $scope.$on("prizeWon", function (event, data) {
            $timeout(function(){
                $scope.prize = $scope.temp;
            }, 2000);
        });
    })
    .factory('LotteryFactory', function ($resource) {
        return $resource('/shop/rest', null, {
            spin: {
                method: 'GET',
                url: "/shop/rest/lottery/spin",
                isArray: false,
            },
            won: {
                method: 'POST',
                url: "/shop/rest/lottery/won",
                params: {
                    ind: '@ind'
                },
                isArray: false,
            }
        })
    });


// Helpers
var blackHex = '#fff',
    whiteHex = '#fff',
    shuffle = function (o) {
        for (var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x)
            ;
        return o;
    },
    halfPI = Math.PI / 2,
    doublePI = Math.PI * 2;

String.prototype.hashCode = function () {
    // See http://www.cse.yorku.ca/~oz/hash.html
    var hash = 5381,
        i;
    for (i = 0; i < this.length; i++) {
        char = this.charCodeAt(i);
        hash = ((hash << 5) + hash) + char;
        hash = hash & hash; // Convert to 32bit integer
    }
    return hash;
};

Number.prototype.mod = function (n) {
    return ((this % n) + n) % n;
};
let W = window.innerWidth;
let H = window.innerHeight;

// WHEEL!
var wheel = {
    timerHandle: 0,
    timerDelay: 33,

    angleCurrent: 0,
    angleDelta: 0,

    size: 130,

    canvasContext: null,

    colors: ['#003366', '#FF6600', '#CCCC00', '#006600', '#3333CC', '#CC0066', '#FF3300', '#009900', '#6600CC', '#33CC33', '#0066CC', '#FF0066', '#3300FF', '#00CC00', '#FFCC00'],

    segments: [],

    seg_colors: [], // Cache of segments to colors

    maxSpeed: Math.PI / 16,

    upTime: 1000, // How long to spin up for (in ms)
    downTime: 5000, // How long to slow down for (in ms)

    spinStart: 0,

    frames: 0,
    lastSteps: 5,
    prize: undefined,

    centerX: 140,
    centerY: 140,
    lastAngleDelta: 0,

    winnerIndex: function () {
        let len = wheel.segments.length;
        return len - Math.floor((wheel.angleCurrent / doublePI) * len) - 1;
    },
    winner: function () {
        return wheel.segments[wheel.winnerIndex()];
    },
    setPrize: function (val) {
        return wheel.prize = val;
    },
    dropPrize: function () {
        return wheel.prize = undefined;
    },
    spin: function () {
        // Start the wheel only if it's not already spinning
        if (wheel.timerHandle === 0) {
            wheel.win = undefined;
            wheel.spinStart = new Date().getTime();
            wheel.maxSpeed = Math.PI / (16 + Math.random()); // Randomly vary how hard the spin is
            wheel.frames = 0;
            wheel.lastSteps = 3;
            // wheel.sound.play();

            wheel.timerHandle = setInterval(wheel.onTimerTick, wheel.timerDelay);
        }
    },

    onTimerTick: function () {
        var duration = (new Date().getTime() - wheel.spinStart);
        var progress = 0;
        var finished = false;

        wheel.frames++;
        wheel.draw();

        if (wheel.prize !== undefined) {
            wheel.angleDelta = wheel.lastAngleDelta;
            wheel.angleDelta = (9 * wheel.lastAngleDelta) / 10;
            if (wheel.angleDelta < 0.05) {
                wheel.angleDelta = wheel.lastAngleDelta;
                if (wheel.winnerIndex() === wheel.prize.index) {
                    if(wheel.lastSteps<0){
                        finished = true;
                    }
                    wheel.lastSteps--;
                }
            }
        } else {
            wheel.angleDelta = wheel.maxSpeed * Math.sin(halfPI);
        }

        wheel.lastAngleDelta = wheel.angleDelta;
        wheel.angleCurrent += wheel.angleDelta;
        while (wheel.angleCurrent >= doublePI) {
            // Keep the angle in a reasonable range
            wheel.angleCurrent -= doublePI;
        }
        if (finished) {
            wheel.dropPrize();
            clearInterval(wheel.timerHandle);
            if (console) {
                var element = angular.element($("#canvas"));
                var scope = element.scope();
                scope.$root.$broadcast('prizeWon', wheel.winnerIndex());
                console.log("You won! " + wheel.winner());

            }
            wheel.timerHandle = 0;
            wheel.angleDelta = 0;
        }

        /*
        // Display RPM
        var rpm = (wheel.angleDelta * (1000 / wheel.timerDelay) * 60) / (Math.PI * 2);
        $("#counter").html( Math.round(rpm) + " RPM" );
         */
    },

    init: function (optionList) {
        try {
            if (W > 500) {
                canvas.width = 400;
                canvas.height = 400;
                this.centerX = 200;
                this.centerY = 200;
                this.size = 180;
            } else if (W <= 500) {
                canvas.width = 280;
                canvas.height = 280;
                this.centerX = 140;
                this.centerY = 140;
                this.size = 130;
            }
            wheel.initWheel();
            wheel.initAudio();
            wheel.initCanvas();
            wheel.draw();

            $.extend(wheel, optionList);

        } catch (exceptionData) {
            alert('Wheel is not loaded ' + exceptionData);
        }

    },

    initAudio: function () {
        var sound = document.createElement('audio');
        sound.setAttribute('src', 'wheel.mp3');
        wheel.sound = sound;
    },

    initCanvas: function () {
        var canvas = $('#canvas')[0];
        // canvas.addEventListener("click", wheel.spin, false);
        wheel.canvasContext = canvas.getContext("2d");
    },

    initWheel: function () {
        shuffle(wheel.colors);
    },

    // Called when segments have changed
    update: function () {
        // Ensure we start mid way on a item
        //var r = Math.floor(Math.random() * wheel.segments.length);
        var r = 0,
            segments = wheel.segments,
            len = segments.length,
            colors = wheel.colors,
            colorLen = colors.length,
            seg_color = [], // Generate a color cache (so we have consistant coloring)
            i
        wheel.angleCurrent = ((r + 0.5) / wheel.segments.length) * doublePI;

        for (i = 0; i < len; i++) {
            seg_color.push(colors [segments[i].hashCode().mod(colorLen)]);
        }
        wheel.seg_color = seg_color;

        wheel.draw();
    },

    draw: function () {
        wheel.clear();
        wheel.drawWheel();
        wheel.drawNeedle();
    },

    clear: function () {
        wheel.canvasContext.clearRect(0, 0, 1000, 800);
    },

    drawNeedle: function () {
        var ctx = wheel.canvasContext,
            centerX = wheel.centerX,
            centerY = wheel.centerY,
            size = wheel.size,
            i,
            centerSize = centerX + size,
            len = wheel.segments.length,
            winner;

        ctx.lineWidth = 2;
        ctx.strokeStyle = blackHex;
        ctx.fillStyle = whiteHex;

        ctx.beginPath();

        ctx.moveTo(centerSize - 10, centerY);
        ctx.lineTo(centerSize + 10, centerY - 10);
        ctx.lineTo(centerSize + 10, centerY + 10);
        ctx.closePath();

        ctx.shadowColor = "black";
        ctx.shadowBlur = 2;
        ctx.shadowOffsetX = .1;
        ctx.shadowOffsetY = .1;

        ctx.stroke();
        ctx.fill();

        // Which segment is being pointed to?
        i = len - Math.floor((wheel.angleCurrent / doublePI) * len) - 1;

        // Now draw the winning name
        ctx.textAlign = "left";
        ctx.textBaseline = "middle";
        ctx.fillStyle = blackHex;
        ctx.font = "1em Arial";
        winner = wheel.segments[i] || 'Choose at least 1 Venue';
        ctx.fillText(winner, centerSize + 20, centerY);
    },

    drawSegment: function (key, lastAngle, angle) {
        var ctx = wheel.canvasContext,
            centerX = wheel.centerX,
            centerY = wheel.centerY,
            size = wheel.size,
            colors = wheel.seg_color,
            value = wheel.segments[key];

        //ctx.save();
        ctx.beginPath();

        // Start in the centre
        ctx.moveTo(centerX, centerY);
        ctx.arc(centerX, centerY, size, lastAngle, angle, false); // Draw an arc around the edge
        ctx.lineTo(centerX, centerY); // Now draw a line back to the centre

        // Clip anything that follows to this area
        //ctx.clip(); // It would be best to clip, but we can double performance without it
        ctx.closePath();

        var sz = size / 2;
        var gradient = ctx.createRadialGradient(wheel.centerX - sz, wheel.centerY - sz, size, wheel.centerX + sz, wheel.centerY + sz, size);
        gradient.addColorStop(0, 'black');
        gradient.addColorStop(.6, colors[key]);
        gradient.addColorStop(1, colors[key]);

        ctx.fillStyle = gradient;
        ctx.fill();
        ctx.stroke();

        // Now draw the text
        ctx.save(); // The save ensures this works on Android devices
        ctx.translate(centerX, centerY);
        ctx.rotate((lastAngle + angle) / 2);

        ctx.fillStyle = whiteHex;
        ctx.fillText(value.substr(0, 20), size - 25, 0);
        ctx.restore();
    },

    drawWheel: function () {
        var ctx = wheel.canvasContext,
            angleCurrent = wheel.angleCurrent,
            lastAngle = angleCurrent,
            len = wheel.segments.length,
            centerX = wheel.centerX,
            centerY = wheel.centerY,
            size = wheel.size,
            angle,
            i;

        ctx.lineWidth = 1;
        ctx.strokeStyle = blackHex;
        ctx.textBaseline = "middle";
        ctx.textAlign = "right";
        ctx.font = "1.2em Arial";

        for (i = 1; i <= len; i++) {
            angle = doublePI * (i / len) + angleCurrent;
            wheel.drawSegment(i - 1, lastAngle, angle);
            lastAngle = angle;
        }

        // Draw a center circle
        ctx.beginPath();
        ctx.arc(centerX, centerY, 20, 0, doublePI, false);
        ctx.closePath();

        var gradient = ctx.createRadialGradient(wheel.centerX - 5, wheel.centerY - 5, 0, wheel.centerX - 5, wheel.centerY - 5, 25);
        gradient.addColorStop(0, 'gold');
        gradient.addColorStop(.6, 'goldenrod');
        gradient.addColorStop(.9, 'darkgoldenrod');
        gradient.addColorStop(1, '#7D540A');
        ctx.fillStyle = gradient;
        ctx.fill();
        ctx.stroke();

        gradient = ctx.createLinearGradient(0, 0, wheel.centerX, wheel.centerY);
        gradient.addColorStop(0, '#eaeaea');
        gradient.addColorStop(1, 'gold');

        ctx.shadowColor = "black";
        ctx.shadowBlur = 2;
        ctx.shadowOffsetX = .1;
        ctx.shadowOffsetY = .1;

        ctx.strokeStyle = gradient;

        // Draw outer circle
        ctx.beginPath();
        ctx.arc(centerX, centerY, size - 10, 0, doublePI, false);
        ctx.closePath();

        ctx.lineWidth = 12;
        //ctx.strokeStyle = blackHex;
        ctx.stroke();
    }
};
$(function () {
    var $venues = $('#prizes'),
        $venueName = $('#name'),
        $venueType = $('#types'),
        venueTypes = [],
        $list = $('<ul/>'),
        $types = $('<ul/>'),
        $filterToggler = $('#filterToggle'),
        arrayUnique = function (a) {
            return a.reduce(function (p, c) {
                if (p.indexOf(c) < 0) {
                    p.push(c);
                }
                return p;
            }, []);
        };

    $.each(prizes, function (index, venue) {
        $list.append(
            $("<li/>")
                .append(
                    $("<input />").attr({
                        id: 'venue-' + index
                        , name: venue.name
                        , value: venue.name
                        , type: 'checkbox'
                        , checked: true
                    })
                        .change(function () {
                            var cbox = this,
                                segments = wheel.segments,
                                i = segments.indexOf(cbox.value);

                            if (cbox.checked && i === -1) {
                                segments.push(cbox.value);
                            } else if (!cbox.checked && i !== -1) {
                                segments.splice(i, 1);
                            }

                            segments.sort();
                            wheel.update();
                        })
                ).append(
                $('<label />').attr({
                    'for': 'venue-' + index
                })
                    .text(venue.name)
            )
        );
        venueTypes.push(venue.type);
    });
    $.each(arrayUnique(venueTypes), function (index, venue) {
        $types.append(
            $("<li/>")
                .append(
                    $("<input />").attr({
                        id: 'venue-type-' + index
                        , name: venue
                        , value: venue
                        , type: 'checkbox'
                        , checked: true
                    })
                        .change(function () {
                            var $this = $(this), i;
                            for (i = 0; i < prizes.length; i++) {
                                if (prizes[i].type === $this.val()) {
                                    $('[name="' + prizes[i].name + '"]').prop("checked", $this.prop('checked')).trigger('change');
                                }
                            }
                        })
                ).append(
                $('<label />').attr({
                    'for': 'venue-' + index
                })
                    .text(venue)
            )
        )
    });

    $venueName.append($list);
    $venueType.append($types);
    // Uses the tinysort plugin, but our array is sorted for now.
    //$list.find('>li').tsort("input", {attr: "value"});

    wheel.init();

    $.each($venueName.find('ul input:checked'), function (key, cbox) {
        wheel.segments.push(cbox.value);
    });

    wheel.update();
    $venues.slideUp().data("open", false);
    $filterToggler.on("click", function () {
        if ($venues.data("open")) {
            $venues.slideUp().data("open", false);
        } else {
            $venues.slideDown().data("open", true);
        }
    });

    $('.checkAll').on("click", function () {
        $(this).parent().next('div').find('input').prop('checked', $(this).prop('checked')).trigger("change");
    });
});

window.onresize = function (event) {
    W = window.innerWidth;
    // console.log(W);
    wheel.init();
};

function random(limit){
    return Math.random() * limit;
}



// Promises
var _eid_promises = {};
// Turn the incoming message from extension
// into pending Promise resolving
window.addEventListener("message", function(event) {
    if(event.source !== window) return;
    if(event.data.src && (event.data.src === "background.js")) {
        console.log("Page received: ");
        console.log(event.data);
        // Get the promise
        if(event.data.nonce) {
            var p = _eid_promises[event.data.nonce];
            // resolve
            if(event.data.result === "ok") {
                if(event.data.signature !== undefined) {
                    p.resolve({hex: event.data.signature});
                } else if(event.data.version !== undefined) {
                    p.resolve(event.data.extension + "/" + event.data.version);
                } else if(event.data.cert !== undefined) {
                    p.resolve({hex: event.data.cert});
                } else {
                    console.log("No idea how to handle message");
                    console.log(event.data);
                }
            } else {
                // reject
                p.reject(new Error(event.data.result));
            }
            delete _eid_promises[event.data.nonce];
        } else {
            console.log("No nonce in event msg");
        }
    }
}, false);


function TokenSigning() {
    function nonce() {
        var val = "";
        var hex = "abcdefghijklmnopqrstuvwxyz0123456789";
        for(var i = 0; i < 16; i++) val += hex.charAt(Math.floor(Math.random() * hex.length));
        return val;
    }

    function messagePromise(msg) {
        return new Promise(function(resolve, reject) {
            // amend with necessary metadata
            msg["nonce"] = nonce();
            msg["src"] = "page.js";
            // send message
            window.postMessage(msg, "*");
            // and store promise callbacks
            _eid_promises[msg.nonce] = {
                resolve: resolve,
                reject: reject
            };
        });
    }
    this.getCertificate = function(options) {
        var msg = {type: "CERT", lang: options.lang, filter: options.filter};
        console.log("getCertificate()");
        return messagePromise(msg);
    };
    this.sign = function(cert, hash, options) {
        var msg = {type: "SIGN", cert: cert.hex, hash: hash.hex, hashtype: hash.type, lang: options.lang, info: options.info};
        console.log("sign()");
        return messagePromise(msg);
    };
    this.getVersion = function() {
        console.log("getVersion()");
        return messagePromise({
            type: "VERSION"
        });
    };
}