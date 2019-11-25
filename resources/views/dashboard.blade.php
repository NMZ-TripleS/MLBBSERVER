<html>
<head>
    <title>Be Good Luck</title>
    <script type="text/javascript" src="{{asset('js/Winwheel.js')}}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        td.the_wheel
        {
            background-image: url("{{asset("images/wheel_back.png")}}");
            background-position: center;
            background-repeat: no-repeat;
        }
        button{
            line-height: 40px;
            background-color: #3700B3;
            border: none;
            color: white;
        }
    </style>
</head>
<body class="my-background">
<div align="center" class="w-400">
    <table cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td>
                <div class="power_controls">
                    <button id="spin_button" onClick="startSpin(10);">10 Coin Spin</button>
                    <br /><br />
                </div>
                <div class="power_controls">
                    <button id="spin_button" onClick="startSpin(20);">20 Coin Spin</button>
                    <br /><br />
                </div>
                <div class="power_controls">
                    <button id="spin_button" onClick="startSpin(30);">30 Coin Spin</button>
                    <br /><br />
                </div>
            </td>
            <td width="438" height="582" class="the_wheel" align="center" valign="center">
                <canvas id="canvas" width="300" height="300">
                    <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
                </canvas>
            </td>
        </tr>
    </table>
</div>
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

<script>
    // Create new wheel object specifying the parameters at creation time.
    let theWheel = new Winwheel({        // Set outer radius so wheel fits inside the background.
        'innerRadius'     : 75,         // Make wheel hollow so segments don't go all way to center.
        'textFontSize'    : 24,         // Set default font size for the segments.
        'textOrientation' : 'horizontal', // Make text vertial so goes down from the outside of wheel.
        'textAlignment'   : 'inner',    // Align text to outside of wheel.
        'numSegments'     : 12,         // Specify number of segments.
        'segments'        :             // Define segments including colour and text.
            [                               // font size and test colour overridden on backrupt segments.
                {'fillStyle' : '#7600bb', 'text' : '1/2 D', 'textFontSize' : 16, 'textFillStyle' : '#ffffff'},
                {'fillStyle' : '#b300bb', 'text' : '1 D', 'textFontSize' : 16, 'textFillStyle' : '#ffffff'},
                {'fillStyle' : '#772200', 'text' : '2 D', 'textFontSize' : 16, 'textFillStyle' : '#ffffff'},
                {'fillStyle' : '#7600bb', 'text' : '1/4 D', 'textFontSize' : 16, 'textFillStyle' : '#ffffff'},
                {'fillStyle' : '#7600bb', 'text' : '1/2 D', 'textFontSize' : 16, 'textFillStyle' : '#ffffff'},
                {'fillStyle' : '#b300bb', 'text' : '2 D', 'textFontSize' : 16, 'textFillStyle' : '#ffffff'},
                {'fillStyle' : '#772200', 'text' : '4 D', 'textFontSize' : 16, 'textFillStyle' : '#ffffff'},
                {'fillStyle' : '#7600bb', 'text' : '1/4 D', 'textFontSize' : 16, 'textFillStyle' : '#ffffff'},
                {'fillStyle' : '#7600bb', 'text' : '1/2 D', 'textFontSize' : 16, 'textFillStyle' : '#ffffff'},
                {'fillStyle' : '#b300bb', 'text' : '1 D', 'textFontSize' : 16, 'textFillStyle' : '#ffffff'},
                {'fillStyle' : '#772200', 'text' : '5 D', 'textFontSize' : 16, 'textFillStyle' : '#ffffff'},
                {'fillStyle' : '#7600bb', 'text' : '1/4 D', 'textFontSize' : 16, 'textFillStyle' : '#ffffff'},
            ],
        'animation' :           // Specify the animation to use.
            {
                'type'     : 'spinToStop',
                'duration' : 10,    // Duration in seconds.
                'spins'    : 3,     // Default number of complete spins.
                'callbackFinished' : alertPrize,
                'callbackSound'    : playSound,   // Function to call when the tick sound is to be triggered.
                'soundTrigger'     : 'pin'        // Specify pins are to trigger the sound, the other option is 'segment'.
            },
        'pins' :				// Turn pins on.
            {
                'number'     : 12,
                'fillStyle'  : 'silver',
                'outerRadius': 4,
            }
    });

    // Loads the tick audio sound in to an audio object.
    let audio = new Audio("{{ asset('songs/tick.mp3') }}");

    // This function is called when the sound is to be played.
    function playSound()
    {
        // Stop and rewind the sound if it already happens to be playing.
        audio.pause();
        audio.currentTime = 0;
        // Play the sound.
        audio.play();
    }

    // Vars used by the code in this page to do power controls.
    let wheelSpinning = false;

    // -------------------------------------------------------
    // Function to handle the onClick on the power buttons.
    // -------------------------------------------------------

    // -------------------------------------------------------
    // Click handler for spin button.
    // -------------------------------------------------------
    function startSpin(count)
    {
        reducePoints(count);
    }
    function reducePoints(count) {
        var id = '<?php echo Auth::user()->id; ?>';

        $.ajax({
            type:'POST',
            url:'{{asset("api/reducepoints")}}',
            data:{"points":count,"id":id},
            success:function(data) {
                if (data.success){
                wheelPower = 3;
                theWheel.animation.stopAngle = theWheel.getRandomForSegment(data.stopat);
                // Ensure that spinning can't be clicked again while already running.
                if (wheelSpinning == false) {
                    // Based on the power level selected adjust the number of spins for the wheel, the more times is has
                    // to rotate with the duration of the animation the quicker the wheel spins.
                    if (wheelPower == 1) {
                        theWheel.animation.spins = 3;
                    } else if (wheelPower == 2) {
                        theWheel.animation.spins = 6;
                    } else if (wheelPower == 3) {
                        theWheel.animation.spins = 10;
                    }

                    // Disable the spin button so can't click again while wheel is spinning.
                    document.getElementById('spin_button').src       = "<?php echo ('images/spin_off.png')?>";
                    document.getElementById('spin_button').className = "";

                    // Begin the spin animation by calling startAnimation on the wheel object.
                    theWheel.startAnimation();

                    // Set to true so that power can't be changed and spin button re-enabled during
                    // the current animation. The user will have to reset before spinning again.
                    wheelSpinning = true;
                }

            }else{
                    alert(data.data);
                }
            }
        });
    }
    // -------------------------------------------------------
    // Function for reset button.
    // -------------------------------------------------------
    function resetWheel()
    {
        theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
        theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
        theWheel.draw();                // Call draw to render changes to the wheel.

        wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
    }

    // -------------------------------------------------------
    // Called when the spin animation has finished by the callback feature of the wheel because I specified callback in the parameters.
    // -------------------------------------------------------
    function alertPrize(indicatedSegment)
    {
        // Just alert to the user what happened.
        // In a real project probably want to do something more interesting than this with the result.
        if (indicatedSegment.text == 'LOOSE TURN') {
            alert('Sorry but you loose a turn.');
        } else if (indicatedSegment.text == 'BANKRUPT') {
            alert('Oh no, you have gone BANKRUPT!');
        } else {
            alert("You have won " + indicatedSegment.text);
        }
    }
</script>
</body>
</html>
