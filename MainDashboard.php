

<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <title>Main Dashboard</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800">
        <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/css/styles.css">
        <link rel="stylesheet" href="/css/tail.datetime-default-orange.css">
        <!-- <link rel="stylesheet" href="/css/style.min.css"> -->


<style type="text/css">

.container { margin-top: 10px; }

.table-header-rotated {
  border-collapse: collapse;
}
.table-header-rotated td {
  width: 30px;
}
 .table-header-rotated th {
  padding: 5px 10px;
}
.table-header-rotated td {
  text-align: center;
  padding: 10px 5px;
  border: 1px solid #ccc;
}
 .table-header-rotated th.rotate {
  height: 140px;
  white-space: nowrap;
}
 .table-header-rotated th.rotate > div {
  -webkit-transform: translate(25px, 51px) rotate(315deg);
      -ms-transform: translate(25px, 51px) rotate(315deg);
          transform: translate(25px, 51px) rotate(315deg);
  width: 30px;
}
 .table-header-rotated th.rotate > div > span {
  border-bottom: 1px solid #ccc;
  padding: 5px 10px;
}
.table-header-rotated th.row-header {
  padding: 0 10px;
  border-bottom: 1px solid #ccc;
}

.plus, .minus {
  display: inline-block; 
  background-repeat: no-repeat;
  background-size: 16px 16px !important;
  width: 16px;
  height: 16px; 
          /*vertical-align: middle;*/
      }

  .plus {
      background-image: url(https://img.icons8.com/color/48/000000/plus.png);
  }

  .minus {
      background-image: url(https://img.icons8.com/color/48/000000/minus.png);
  }

  ul {
      list-style: none;
      padding: 0px 0px 0px 20px;
  }

ul.inner_ul li:before {
    content: "├";
    font-size: 18px;
    margin-left: -11px;
    margin-top: -5px;
    vertical-align: middle;
    float: left;
    width: 8px;
    color: #41424e;
}

ul.inner_ul li:last-child:before {
    content: "└";
}

.inner_ul {
    padding: 0px 0px 0px 35px;
} 


</style>
</head>


<body>
  <div class="container">
    <div id="nav-placeholder"></div>
  </div>


  <div class="container" style="margin-top: 20px;">
    <div class="row" >
      <h1 id="title" style="width: 100%;"> EDGE LOG & DEBUG</h1>
    </div>




    <div class="row" style="margin-top: 20px;">

    <div class="col-3">
      From:<input id="datetimepicker3" name="from_date" value="" placeholder="" onchange=""/>
    </div>

    <div class="col-3">
      To:<input id="datetimepicker4" name="to_date"  value="" placeholder="" onchange=""/>
    </div>

    <div class="col-2">
      <select id="SensorSelect" class="form-select" style="width: 100%;"  onChange="console.log('do something here');">
      <option selected>Loading ...</option>
      </select>
    </div>

    <div class="col-2">
      <select id="MessageTypeSelect" class="form-select" style="width: 100%;"> <!--  margin-top:10px;-->
        <option selected>Select Msg. Type</option>
        <option value="DOWNTIMES">DOWNTIMES</option>
        <option value="PRODUCTION">PRODUCTION</option>
        <option value="TAGS">TAGS</option>
      </select>
    </div>

    <div class="col-1">
      <button id="ShowDataOnTable"  value="TBD" class="fa btn-block fa-database btn btn-primary" onclick="ShowDataOnTable();"> </button>
    </div>

    <div class="col-1">
      <button id="RequestDownloadButton"  value="TBD" name="submit" class="fa btn-block fa-download btn btn-primary" onclick="downloadData();"> </button>
    </div>
  </div>
  </div>
  



  
  


  <div class="col-12" id="mytable"></div>

  <div class="container">
    <footer class="row justify-content-center">
      <span style="color: Black">Created by:&nbsp;</span>
      <span style="color: #FA5A1E"> The Logoplaste Automation Team</span>
    </footer>
  </div>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="main_live_view.php">Homepage</a>
      </li>
    </ul>
  </div>




<script src="/js/jquery.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/Chart.min.js"></script>
<script src="/js/highcharts.js"></script>
<script src="/js/jstree.min.js"></script>



<script src="/js/highcharts-more.js"></script>
<script src="/js/exporting.js"></script>
<script src="/js/tail.datetime.js"></script>
</body>



<script>







var myChart=null;



window.onload = function() {



  updateSelectSensor();
    /*UpdateTagsSimple(2);
    UpdateTagsSimple(3);
    UpdateTagsSimple(4);
    UpdateTagsSimple(5);
    UpdateTagsSimple(6);
    UpdateTagsSimple(7);
    UpdateTagsSimple(8);
    UpdateTagsSimple(9);
    generateDropdown();
    generateModalContent(sensor_id_input[0]);*/
};


function ShowDataOnTable(){

  
  var MsgType = document.getElementById('MessageTypeSelect').value;
  var selectsensorID = document.getElementById('SensorSelect');
  var sensorID = selectsensorID.options[selectsensorID.selectedIndex].value;
  var from_date = document.getElementById("datetimepicker3").value;
  var to_date = document.getElementById("datetimepicker4").value;
  var consoleDebug ="Attempting to load data for: "+ MsgType + " " + sensorID + " " + from_date + " " + to_date
  
  document.getElementById("mytable").innerHTML = consoleDebug;
	var url = "EdgeMongoReturn.php?TaglogBySensorID=True&from_date="+from_date+"&to_date="+to_date+"&sensorID="+sensorID+"&MsgType="+MsgType;

  console.log(url);

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("mytable").innerHTML = this.responseText;
    }
  };        
  xhttp.open("GET", url, true);
  xhttp.send();
}



function updateSelectSensor() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("SensorSelect").innerHTML = this.responseText;
    }
  };        
  xhttp.open("GET", "EdgeMongoReturn.php?SensorSelect=1", true);
  xhttp.send();
}                 


  function getCheckedBoxes(chkboxName) {
    var checkboxes = document.getElementsByName(chkboxName);
    var checkboxesChecked = [];
    // loop over them all
    for (var i=0; i<checkboxes.length; i++) {
     // And stick the checked ones onto an array...
     if (checkboxes[i].checked) {
        checkboxesChecked.push(checkboxes[i]);
     }
    }
    // Return the array if it is non-empty, or null
    return checkboxesChecked.length > 0 ? checkboxesChecked : null;
  }


 function downloadData(){

    var from_date = document.getElementById("datetimepicker3").value;
    var to_date = document.getElementById("datetimepicker4").value;
    var variableType = document.getElementById("VariableSelect").value;

    var TimeIntervalSelect = document.getElementById("TimeIntervalSelect").value;

    var sensorIDs_array = [];
    var tags_array = [];
    var tagsLabels_array = [];

    var checkedItems = getCheckedBoxes("dropdown_checkboxes");

    console.log("downloadData()");
    
    for (var i = 0; i < checkedItems.length; i++) {
      var chkItemId = checkedItems[i].id;
      for (var j = 0; j < jsonTagConfig.length; j++) {
        if(chkItemId === jsonTagConfig[j].div_id){

          sensorIDs_array.push(jsonTagConfig[j].sensor_id);          
          
          if(variableType == 1){  
            tags_array.push(jsonTagConfig[j].power_tagName);
            tagsLabels_array.push(jsonTagConfig[j].power_tagLabel);
          }
          
          if(variableType == 2){  
            tags_array.push(jsonTagConfig[j].energy_tagName);
            tagsLabels_array.push(jsonTagConfig[j].energy_tagLabel);
          }
  

        }
      }
    }


  // tagsLabels_array


  var url = "ReturnChartData.php?from_date="+from_date+"&to_date="+to_date+"&sensor_ids="+sensorIDs_array+"&tags_list="+tags_array+"&TimeIntervalSelect="+TimeIntervalSelect;


    var str = "";

$.getJSON(url, function(result){

    var tspush = [];
    var datasets_data = [];
    var datasets_data_toAppend = null;

    var JSON_result = result.reverse();

    var jsonObject = JSON.stringify(JSON_result);


    var tagKeys = (Object.keys(JSON_result[0])); 
    var header = "timestamp";

    var unique_tag_sen_id = [];

    for(var k=0; k<sensorIDs_array.length;k++) {
        unique_tag_sen_id[k] = sensorIDs_array[k] + "_" + tags_array[k];
    }
    console.log(unique_tag_sen_id);

    for(var j=0; j<tagKeys.length;j++) { 

      if(tagKeys[j] !== "ts"){ // not the timestamp
        console.log(tagKeys[j]);
        var index = unique_tag_sen_id.indexOf(tagKeys[j]);

        header += "," + tagsLabels_array[index];
      }
    }
    header += "\n";



  // JSON to CSV Converter
    var array = typeof jsonObject != 'object' ? JSON.parse(jsonObject) : jsonObject;
    str = header;

    for (var i = 0; i < array.length; i++) {
        var line = '';
        for (var index in array[i]) {
            if (line != '') line += ','

            line += array[i][index];
        }

        str += line + '\r\n';
    }

    //console.log(header);
    console.log(str);
    var hiddenElement = document.createElement('a');
    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(str);
    hiddenElement.target = '_blank';
    hiddenElement.download = 'GraphData.csv';
    hiddenElement.click();
    });




}



    


function UpdateTagsSimple(sensor_id){
var url = "Load_Data_From_DB_by_SensorID.php?sensor_id="+ sensor_id;
console.log(url);

var xmlHttp = new XMLHttpRequest();
xmlHttp.open("GET", url, true); // true for asynchronous
xmlHttp.send(null);

xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200){

        var Arr = JSON.parse(xmlHttp.responseText);

        console.log(Arr);
        Object.keys(Arr).forEach(function(k){
            //console.log(k + ' - ' + Arr[k]);
            if(document.getElementById(k)){
              if(k.includes('lastupdate')){
                
                var d = new Date(Arr[k] * 1000);
                Arr[k] = d;
              }
                
                document.getElementById(k).innerHTML=Arr[k];
            }
            
            });
        }
    }     


    setTimeout(UpdateTagsSimple.bind(null, sensor_id),60000);

}

    tail.DateTime("#datetimepicker3", {position: "bottom"});
    tail.DateTime("#datetimepicker4", {position: "bottom"});


//$(function(){
//            $("#nav-placeholder").load("navbar_machines.php");
//});


function check_fst_lvl(dd) {
    //var ss = $('#' + dd).parents("ul[id^=bs_l]").attr("id");
    var ss = $('#' + dd).parent().closest("ul").attr("id");
    if ($('#' + ss + ' > li input[type=checkbox]:checked').length == $('#' + ss + ' > li input[type=checkbox]').length) {
        //$('#' + ss).siblings("input[id^=c_bs]").prop('checked', true);
        $('#' + ss).siblings("input[type=checkbox]").prop('checked', true);
    }
    else {
        //$('#' + ss).siblings("input[id^=c_bs]").prop('checked', false);
        $('#' + ss).siblings("input[type=checkbox]").prop('checked', false);
    }

}

function pageLoad() {
    $(".plus").click(function () {
        $(this).toggleClass("minus").siblings("ul").toggle();
    })
}


</script>
