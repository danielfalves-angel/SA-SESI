 const ctx2 = document.getElementById('circulo');

    new Chart(ctx2, {
      type: 'pie',
      data: {
      labels: ['Defeitos', 'Sensores Novos', 'Servissos', 'Revisões', 'Produtos'],
        datasets: [{
          label: 'Linguagens',
        data: [7, 19, 9, 5, 15],
          backgroundColor: [
            '#FF6384',
            '#36A2EB',
            '#FFCE56',
            '#4BC0C0',
            '#3bbe51'
          ],
          borderColor: '#fff',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'right'
          },
          
        }
      }
    });