
<!DOCTYPE html>
<html>
    <head>
        <title>Capture Webpage Screenshot</title>
        <!-- include the jquery and jquery ui -->
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        <!-- this script helps us to capture any div --> 
        <script src="html2canvas.js"></script>

        <style>
            /* these are just styles added for this demo page */
            #canvas{
                width: 302px;
                height: 170px;
                margin: 0 auto;
                background-repeat: no-repeat;
                background-size: contain;
                border: solid rgb(23, 25, 23);
                border-width: 2px;
            }
            .movable_div{
                color: black;
                font-family: Verdana;
                cursor: move;
                position: absolute;
            }
            #design{
                width: 242px;
                margin: 0 auto;
                height: 70px;
                background: #7f6969;
                color : white;
                padding: 30px;
                border: solid rgb(23, 25, 23);
                border-width: 2px;  
            }

        </style>
    </head>
    <body>  
		<center><h3>Edit Image Before Uploading</h3></center>
        <div id="design">
                <div id="controls" style="margin-top: -16px;">
				<input type='file' onchange="readURL(this);" /><br><br><br>
                    <input type="text" value="Guru" id="textbox" style="width: 72px;" placeholder="Enter Text"/>&nbsp;&nbsp;			
                    <input id="slider" type ="range" min ="12" style="width: 58px;" max="50" value ="0"/>&nbsp;&nbsp;
                    <select id="font">
                        <option value="black">Text color</option>
                        <option value="black">Black</option>
                        <option value="white">White</option>
                        <option value="blue">blue</option>
                        <option value="yellow">yellow</option>
                        <option value="green">green</option>

                    </select>
                    &nbsp;&nbsp;
                    <input type="button" value="Circle" id="circle" />&nbsp;&nbsp;
                    <input type="button" value="Box" id="rect" />
                </div>	  
            </center>

            <br />

        </div>
        <div id="canvas">
            
            <div class="movable_div">
                <canvas id="myCanvas" width="30" height="15" style="border:2px solid #0e0f0f;display:none;">
                </canvas>
            </div>
            <div class="movable_div">
                 <canvas id="circle1" style="border:1px solid #0e0f0f;display:none;border-radius: 26px;" width="50" height="50"></canvas>
            </div>
            
               
            <div class="movable_div" id="movable_div">Guru</div>
        </div><br /><br />
        <div class="capture">
            <center><input type="button" value="Capture" id="capture" /></center>
        </div>
        <p align="center">Drag the text and place it wherever you want on the picture</p>
        <script type="text/javascript">
            $(function () {
                var c = document.getElementById("myCanvas");
                var ctx = c.getContext("2d");
                
                var d = document.getElementById("circle");
                var dtx = c.getContext("2d");
                dtx.beginPath();
                dtx.arc(20, 5, 50, 0, 2 * Math.PI);
                dtx.stroke();
                //to make a div draggable
                $('.movable_div').draggable(
                        {containment: "#canvas", scroll: false}
                );

                //to capture the entered text in the textbox 
                $('#textbox').keyup(function () {
                    var text = $(this).val();
                    $('#movable_div').text(text);
                });
$("#rect").click(function(){
        $("#myCanvas").show();
    });
$("#circle").click(function(){
        $("#circle1").show();
    });
 
                //to change the background once the user select
                $('#background').change(function () {
                    var background = $(this).val();

                    $('#canvas').css('background', 'url(' + background + ')');
                });
                $('#font').change(function () {
                    var font = $(this).val();

                    $('.movable_div').css('color', font);
                    
                });

                //font size handler here. 
                $('#slider').change(function () {
                    fontSize = $(this).val();
                    $('.movable_div').css('font-size', fontSize + 'px');
                });

                //here is the hero, after the capture button is clicked
                //he will take the screen shot of the div and save it as image.
                $('#capture').click(function () {
                    //get the div content
                    div_content = document.querySelector("#canvas")
                    //make it as html5 canvas
                    html2canvas(div_content).then(function (canvas) {
                        //change the canvas to jpeg image
                        data = canvas.toDataURL('image/jpeg');

                        //then call a super hero php to save the image
                        save_img(data);
                    });
                });
            });


            //to save the canvas image
            function save_img(data) {
                //ajax method.
                //alert("dfdffd")
                $.post('save_jpg.php', {data: data}, function (res) {

                    //if the file saved properly, trigger a popup to the user.
                    if (res != '') {
                        yes = confirm('File saved in output folder');

                    } else {
                        alert('something wrong');
                    }
                });
            }
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#canvas')
                                .css('background-image', 'url(' + e.target.result + ')')
                                .width(302)
                                .height(170);

                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    </body>
</html>

