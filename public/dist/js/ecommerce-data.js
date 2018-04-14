"use strict";$(document).ready(function(){if($('#chart_1').length>0){var data=[{period:'01',iphone:180,},{period:'02',iphone:105,},{period:'03',iphone:250,},{period:'04',iphone:160,},{period:'05',iphone:130,},{period:'06',iphone:155,},{period:'07',iphone:150,},{period:'08',iphone:110,},{period:'09',iphone:170,},{period:'10',iphone:150,},{period:'11',iphone:150,},{period:'12',iphone:150,},{period:'13',iphone:150,},{period:'14',iphone:150,},{period:'15',iphone:160,},{period:'16',iphone:180,},{period:'17',iphone:105,},{period:'18',iphone:250,},{period:'19',iphone:160,},{period:'20',iphone:130,},{period:'21',iphone:155,},{period:'22',iphone:150,},{period:'23',iphone:110,},{period:'24',iphone:170,},{period:'25',iphone:150,},{period:'26',iphone:150,},{period:'27',iphone:150,},{period:'28',iphone:150,},{period:'29',iphone:150,},{period:'30',iphone:160,}];var areaChart=Morris.Area({element:'chart_1',data:data,xkey:'period',ykeys:['iphone'],labels:['iPhone'],pointSize:3,lineWidth:2,pointStrokeColors:['#f2b701'],pointFillColors:['#ffffff'],behaveLikeLine:!0,gridLineColor:'rgba(33,33,33,0.1)',smooth:!1,hideHover:'auto',lineColors:['#f2b701'],resize:!0,gridTextColor:'#878787',gridTextFamily:"Roboto",parseTime:!1,fillOpacity:0.2})}
if($('#chart_7').length>0){var ctx7=document.getElementById("chart_7").getContext("2d");var data7={labels:["lab 1","lab 2","lab 3","lab 4","lab 5"],datasets:[{data:[30,70,300,50,100],backgroundColor:["rgba(177,0,88,1)","rgba(15,79,168,1)","rgba(9,162,117,1)","rgba(220,0,48,1)","rgba(242,183,1,1)"],hoverBackgroundColor:["rgba(177,0,88,1)","rgba(15,79,168,1)","rgba(9,162,117,1)","rgba(220,0,48,1)","rgba(242,183,1,1)"]}]};var doughnutChart=new Chart(ctx7,{type:'doughnut',data:data7,options:{animation:{duration:3000},elements:{arc:{borderWidth:0}},responsive:!0,maintainAspectRatio:!1,percentageInnerCutout:50,legend:{display:!1},tooltips:{backgroundColor:'rgba(33,33,33,1)',cornerRadius:0,footerFontFamily:"'Roboto'"},cutoutPercentage:70,segmentShowStroke:!1}})}
if($('#chart_8').length>0){var ctx7=document.getElementById("chart_8").getContext("2d");var data7={labels:["lab 1","lab 2","lab 3","lab 4"],datasets:[{data:[80,40,20,50],backgroundColor:["rgba(177,0,88,1)","rgba(15,79,168,1)","rgba(220,0,48,1)","rgba(242,183,1,1)"],hoverBackgroundColor:["rgba(177,0,88,1)","rgba(9,162,117,1)","rgba(220,0,48,1)","rgba(242,183,1,1)"]}]};var pieChart=new Chart(ctx7,{type:'pie',data:data7,options:{animation:{duration:3000},responsive:!0,maintainAspectRatio:!1,legend:{display:!1},elements:{arc:{borderWidth:0}},tooltips:{backgroundColor:'rgba(33,33,33,1)',cornerRadius:0,footerFontFamily:"'Roboto'"}}})}
if($('#pie_chart_4').length>0){$('#pie_chart_4').easyPieChart({barColor:'#09a275',lineWidth:20,animate:3000,size:165,lineCap:'square',trackColor:'rgba(33,33,33,0.1)',scaleColor:!1,onStep:function(from,to,percent){$(this.el).find('.percent').text(Math.round(percent))}})}
if($('#datable_1').length>0)
$('#datable_1').DataTable({"bFilter":!1,"bLengthChange":!1,"bPaginate":!1,"bInfo":!1,})});$(window).load(function(){window.setTimeout(function(){$.toast({heading:'Welcome to Libot Philippines',position:'top-center',loaderBg:'#f2b701',icon:'success',hideAfter:3500,stack:6})},3000)});var sparklineLogin=function(){if($('#sparkline_4').length>0){$("#sparkline_4").sparkline([2,4,4,6,8,5,6,4,8,6,6,2],{type:'line',width:'100%',height:'45',lineColor:'#f2b701',fillColor:'#f2b701',maxSpotColor:'#f2b701',highlightLineColor:'rgba(0, 0, 0, 0.2)',highlightSpotColor:'#f2b701'})}
if($('#sparkline_5').length>0){$("#sparkline_5").sparkline([0,2,8,6,8],{type:'bar',width:'100%',height:'45',barWidth:'10',resize:!0,barSpacing:'10',barColor:'#09a275',highlightSpotColor:'#09a275'})}
if($('#sparkline_6').length>0){$("#sparkline_6").sparkline([0,23,43,35,44,45,56,37,40,45,56,7,10],{type:'line',width:'100%',height:'50',lineColor:'rgb(220,0,48)',fillColor:'transparent',spotColor:'#fff',minSpotColor:undefined,maxSpotColor:undefined,highlightSpotColor:undefined,highlightLineColor:undefined})}}
var sparkResize;$(window).resize(function(e){clearTimeout(sparkResize);sparkResize=setTimeout(sparklineLogin,200)});sparklineLogin()