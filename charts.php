<!doctype html>
<html>
    <head>
        <title>Bar Chart</title>
        <script src="Chart.js"></script>
        <meta name = "viewport" content = "initial-scale = 1, user-scalable = no">
        <style>
            canvas{
            }
        </style>
    </head>
    <body>
        <canvas id="canvas" height="450" width="600"></canvas>
<?php 
$array=array
(
    '0' => array
        (
            'product' => 'abc',
            'total' => 21
        ),
    '1' => array
        (
            'product' => 'xyz',
            'total' => 1
        ),
    '2' => array
        (
            'product' => 'pqr',
            'total' => 13
        )
);

?>


<script>
        var lab=[];
        var data=[];
        <?php 
        foreach($array as $tem)
        {

            ?>

            lab.push('<?php echo $tem['product']; ?>');
            data.push('<?php echo $tem['total']; ?>');
        <?php }

        ?>

        var barChartData = {
            labels : lab,
            datasets : [
                {
                    fillColor : "rgba(220,220,220,0.5)",
                    strokeColor : "rgba(220,220,220,1)",
                    data : data
                },

            ]

        }

    var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Bar(barChartData);

    </script>
    </body>
</html>