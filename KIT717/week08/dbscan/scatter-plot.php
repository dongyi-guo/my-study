
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">	
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="http://iotserver.com/canvasjs3.6/canvasjs.min.js"></script>
<script>

var dataPoints = [];
var chart;

window.onload = function () {
    chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        zoomEnabled: true,
        title: {
            text: "Geo Location Clustered"
        },
        axisX: {
            title: "X"
        },
        axisY: {
            title: "Y"
        },
        data: [{
            type: "scatter",
            toolTipContent: "<b>Cluster {cluster}: </b>{x}, {y}",
            dataPoints: dataPoints
        }]
    });

    chart.render();
    fetchClusteredData();
};

function fetchClusteredData() {
    // Fetch cluster data from your server (index.php output in JSON)
    $.getJSON(
        // "http://iotserver.com/dbscan/index.php?data=t1.json&eps=7&mp=3"
        <?php 
            $data = "t1.json";
            $eps = "7";
            $mp = "3";
            if (isset($_GET['data'])) { $data = $_GET['data']; }
            if (isset($_GET['eps'])) { $eps = $_GET['eps']; }
            if (isset($_GET['mp'])) { $mp = $_GET['mp']; }
            echo "\"http://iotserver.com/dbscan/index.php?data=" .
            $data .
            "&eps=" .
            $eps .
            "&mp=" .
            $mp .
            "\"";
        ?>, 
        function(clusterData
        ) {
        if (clusterData.error) {
            console.error(clusterData.error);
            return;
        }

        const clusterColors = generateClusterColors(clusterData.clusters.length); // Generate unique colors for each cluster
        
        // Map points to their clusters with colors
        clusterData.clusters.forEach((cluster, index) => {
            cluster.points.forEach(point => {
                dataPoints.push({
                    x: point.coordinates.x,
                    y: point.coordinates.y,
                    markerColor: clusterColors[index],
                    cluster: cluster.cluster_number
                });
            });
        });

        // Render chart with updated data
        chart.render();
    });
}

function generateClusterColors(numClusters) {
    const colors = [];
    for (let i = 0; i < numClusters; i++) {
        // Generate random colors for clusters
        colors.push(`#${Math.floor(Math.random() * 16777215).toString(16)}`);
    }
    return colors;
}

</script>
</head>
<body>
<div id="chartContainer" style="height: 500px; max-width: 550px; margin: 0px auto;"></div>
</body>
</html>
