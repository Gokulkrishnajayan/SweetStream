// script.js
document.addEventListener('DOMContentLoaded', function () {
    const orderData = [
      { orderId: '001', item: 'Palada Payasam', status: 'Processing', delivery: 'Tomorrow' },
      { orderId: '002', item: 'Semiya Payasam', status: 'Dispatched', delivery: 'Today' }
    ];
  
    const orderTableBody = document.getElementById('orderTableBody');
  
    orderData.forEach(order => {
      const row = document.createElement('tr');
  
      row.innerHTML = `
        <td>${order.orderId}</td>
        <td>${order.item}</td>
        <td>${order.status}</td>
        <td>${order.delivery}</td>
      `;
  
      orderTableBody.appendChild(row);
    });
  });
  