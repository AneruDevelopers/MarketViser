$(document).ready(function(){
    $.ajax({
      url: BASE_URL + 'functions/mostrarEstatisticas' ,
      method: "GET",
      success: function(data) {
        
        var mes = [];
        var qtd = [];
        for(var i = 0; data.length > i; i++) {
    
  
          mes.push(data[i].mes);
      
          qtd.push(data[i].qtd);
        }
  
        var chartdata = {
          labels: mes,
          datasets : [
            {
              label: 'Compras Feitas',
              backgroundColor: 'rgba(72, 1, 255, 0.75)',
              borderColor: 'rgba(200, 200, 200, 0.75)',
              hoverBackgroundColor: 'rgba(15, 6, 23, 1)',
              hoverBorderColor: 'rgba(15, 6, 23, 1)',
              data: qtd
            }
          ]
        };
  
        var ctx = $("#mycanvas");
  
        var barGraph = new Chart(ctx, {
          type: 'bar',
          data: chartdata
        });
      },
      error: function(data) {
        console.log(data);
      }
    });
  });