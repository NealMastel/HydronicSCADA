var googleChartDataArray = [1566071718000,185.1,169.1,73.7,1566071658000,185,170.3,73.6,1566071598000,185.4,168.2,73.8]
var twoDimensionalArray =[];
counter = 0;
for (var i=0;i<3;i++,counter+=4)
{
  var data = [];
  for (var j=0;j<1;j++)
  {
    data.push(new Date(googleChartDataArray[counter]),  googleChartDataArray[counter+1], googleChartDataArray[counter+2], googleChartDataArray[counter+3]);
  }
  twoDimensionalArray.push(data);
}
console.log(twoDimensionalArray)