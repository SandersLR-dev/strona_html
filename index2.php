<?php

session_start();
if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
{
    header('Location: main.php');
    exit();
}

?>


<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Korepetycje</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="style.css"> 
        
    </head>
    <body>
        <div id= "container">
            <div id="logo">
                <h1>Korepetycje</h1>
                Znajdź korepetytora w swojej okolicy !!!
        
                <a href="login.php"><button>Zaloguj się!</button></a>
                <a href="register.php"><button>Zarejestruj się!</button></a>
            </div>
            
            <div id ="content">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lacinia tellus sed lacus dictum, eget maximus odio bibendum. Donec sollicitudin orci magna, ut volutpat ligula sodales vel. Nam et tellus faucibus, malesuada neque et, sollicitudin magna. Phasellus pharetra sodales congue. Quisque malesuada magna a iaculis tempus. Sed vel neque malesuada, rhoncus dui sed, fringilla sem. Nulla facilisi. Sed pulvinar, nunc non malesuada commodo, ante mauris dapibus lacus, a vulputate lorem felis at lectus. Phasellus rhoncus tincidunt velit, a auctor nunc bibendum nec. Nam mollis a erat et mollis. Aliquam erat volutpat.

Maecenas a hendrerit orci, eget viverra lectus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla sagittis velit a ex eleifend, quis pellentesque sem lacinia. Nulla facilisi. Etiam imperdiet a lacus non volutpat. Praesent commodo laoreet viverra. Nullam consequat in velit eu aliquam.

In hac habitasse platea dictumst. Nulla in libero in libero molestie accumsan. Maecenas hendrerit velit non quam eleifend faucibus. Donec nisl ante, faucibus eget consequat a, imperdiet sed enim. Nunc et luctus dui, tempor aliquam neque. Fusce malesuada nisl a nunc sollicitudin, eget auctor nisi congue. Cras varius tortor vitae nisi consequat, non sodales magna malesuada. Mauris erat metus, auctor tempus purus at, tristique dignissim ligula. In sit amet ex a ex congue blandit. Quisque vitae euismod mauris, et bibendum felis. Aenean ac orci id nulla finibus fringilla quis a ex. Duis vel ante convallis, congue libero id, gravida sem. Maecenas tellus ipsum, tincidunt sit amet consectetur id, semper sit amet purus. Maecenas a mi nulla. Nam in faucibus est, quis vulputate metus.

Phasellus volutpat aliquet dignissim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin pellentesque vitae leo sed sodales. Vivamus viverra leo sed tortor elementum, eu porta nibh tristique. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dictum mi sagittis dui scelerisque luctus. Duis in porta metus. Nullam placerat elit sed ligula accumsan rhoncus. Mauris rutrum sed dolor eget pulvinar.

Etiam et nibh mauris. Phasellus rutrum sem consectetur, posuere nulla ornare, finibus felis. Nullam tincidunt, elit ut tincidunt placerat, nisi neque sodales felis, ut feugiat felis ex a quam. Morbi massa urna, facilisis vel maximus non, congue et augue. Pellentesque ullamcorper justo vel nulla ornare rhoncus. Proin et diam nec tortor luctus finibus. Mauris pharetra velit et erat tristique accumsan. Donec finibus purus nec metus suscipit, at volutpat nulla ultricies. Nunc semper diam ac arcu hendrerit pretium. Sed blandit massa non ante porttitor, eget pharetra erat dictum. Nam finibus in nibh et sollicitudin.
                
            
            </div>
            <div id = "footer">
                Dominik Snopek 2020 
            
            </div>
        </div>
    </body>
</html>