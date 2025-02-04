<!DOCTYPE html>
<html>
 
<head>
    <meta charset="utf-8">
    <title>ZingSoft Demo</title>
 
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <style>
        html,
        body,
        #myChart {
            height: 100%;
            width: 100%;
        }
 
        zing-grid[loading] {
            height: 800px;
        }
    </style>
</head>
 
<body>
    <div id='myChart'></div>
    <script>
        ZC.LICENSE = ["b55b025e438fa8a98e32482b5f768ff5"];
        var myData = [24, 68, 48, 70, 40, 15, 30];
 
        var myConfig = {
            "graphset": [{
                "type": "bar",
                "title": {
                    "text": "Data Pulled from MySQL Database"
                },
                "scale-x": {
                    "labels": ["Webster", "Parnel", "Dena", "Tyrell", "Martha", "Summer", "Linton"]
                },
                "series": [{
                    "values": myData
                }]
            }]
        };
 
        zingchart.render({
            id: 'myChart',
            data: myConfig,
            height: "100%",
            width: "100%"
        });
    </script>
</body>
 
</html>