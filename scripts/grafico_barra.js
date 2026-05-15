 const ctx = document.getElementById('barra');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Defeitos', 'Sensores Novos', 'Servissos', 'Revisões', 'Produtos'],
      datasets: [{
        label: 'Gráfico de barra',
        data: [7, 19, 9, 5, 15],
        backgroundColor: [
            '#FF6384',
            '#36A2EB',
            '#FFCE56',
            '#4BC0C0',
            '#3bbe51'
          ],
          
          borderColor: '#fff',
          borderWidth: 1
      }]
    },
    options: {
      scales: {
       
      }
    }
  });