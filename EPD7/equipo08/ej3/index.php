<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <script type="text/javascript">
            var j = 1;
            while (j < 6) {
                var i = 0;
                i = i + j;
                while (i < 10) {
                    document.write(i);
                    i = i + j;
                }
                document.write("<br>");
                j++;
            }
        </script>
    </body>
</html>
