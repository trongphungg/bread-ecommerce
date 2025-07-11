let data = []; 

async function fetchNguyenlieu() {
    const response = await fetch('http://127.0.0.1:8000/api/nguyenlieu');
    const result = await response.json();
    data = result.dsnl;

    data.sort((a, b) => {
        // Chuyển cả hai tên về chữ thường để sắp xếp chính xác
        const nameA = a.tennguyenlieu.toLowerCase();
        const nameB = b.tennguyenlieu.toLowerCase();

        // So sánh tên nguyên liệu
        if (nameA < nameB) {
            return -1; // a trước b
        }
        if (nameA > nameB) {
            return 1; // b trước a
        }
        return 0; // bằng nhau
    });
}

function addRow() {
  const table = document.querySelector("#nguyenlieuTable tbody");
    if (!table) return; // Nếu bảng không tồn tại, không làm gì cả
    // Kiểm tra xem trang hiện tại có cần ô tổng tiền hay không
  const currentPage = window.location.pathname;
  const showTongTien = currentPage.includes('warehouse');

    // Tạo các option cho select từ dữ liệu đã fetch
    const selectOptions = data.map(item => {
        return `<option value="${item.idnguyenlieu}" data-donvi="${item.donvitinh}">${item.tennguyenlieu}</option>`; // Tạo option từ id và name của nguyên liệu
    }).join('');

    // Xây dựng row với các trường cần thiết, nếu showTongTien là true thì sẽ có ô tổng tiền
    const row = `
        <tr>
            <td>
                <select name="idnguyenlieu[]" class="form-control nguyenlieu-select" required>
                    <option value="">-- Chọn nguyên liệu --</option>
                    ${selectOptions}
                </select>
            </td>
            <td><input name="soluong[]" class="form-control" type="number" required></td>
            <td><input name="donvitinh[]" class="form-control" required></td>
            ${showTongTien ? '<td><input name="tongtien[]" class="form-control" oninput="handleCurrencyInput(this)" required></td>' : ''} <!-- Nếu cần thì hiển thị ô tổng tiền -->
            <td><button type="button" onclick="removeRow(this)" class="btn btn-danger btn-sm">-</button></td>
        </tr>
    `;

    // Thêm row vào trong bảng (giả sử có một bảng với id 'nguyenlieuTable')
    document.querySelector("#nguyenlieuTable tbody").insertAdjacentHTML('beforeend', row);
}



fetchNguyenlieu().then(() => {
    addRow(); // Nếu cần thêm row ngay lập tức sau khi fetch xong, uncomment dòng này
});


function removeRow(button) {
    button.closest('tr').remove();
    updateTongTien();
}

function updateTongTien() {
    const tongTienInputs = document.querySelectorAll('input[name="tongtien[]"]');
    let tong = 0;

    tongTienInputs.forEach(input => {
        const val = parseFloat(input.value.replace(/[^\d.-]/g, '')); 
        if (!isNaN(val)) tong += val;
    });

    const totalField = document.getElementById('total');
    totalField.value = tong.toLocaleString('vi-VN') + ' VNĐ';
}



function handleCurrencyInput(input) {
    let value = input.value.replace(/[^\d]/g, '');
    if (value === '') {
        input.value = '';
    } else {
        input.value = new Intl.NumberFormat('vi-VN').format(value) + ' VNĐ';
    }
    let tong = 0;
    document.querySelectorAll('input[name="tongtien[]"]').forEach(item => {
        const val = parseFloat(item.value.replace(/[^\d]/g, ''));
        if (!isNaN(val)) tong += val;
    });
    const totalField = document.getElementById('total');
    if (totalField) {
        totalField.value = tong.toLocaleString('vi-VN') + ' VNĐ';
    }
  }

document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('nguyenlieu-select')) {
            const select = e.target;
            const selectedOption = select.options[select.selectedIndex];
            const donvi = selectedOption.getAttribute('data-donvi');

            // Tìm ô đơn vị ở cột bên cạnh trong cùng <tr>
            const row = select.closest('tr');
            const donviInput = row.querySelector('input[name="donvitinh[]"]');

            if (donviInput) {
                donviInput.value = donvi;
            }
        }
    });
});


//Api Google
async function loadDistricts() {
    const res = await fetch(`http://provinces.open-api.vn/api/p/79?depth=2`);
    const districts = (await res.json()).districts;
    const districtSelect = document.getElementById('quan');
    districtSelect.innerHTML = `<option value="">-- Chọn quận/huyện --</option>` + 
      districts.map(d => `<option value="${d.code}">${d.name}</option>`).join('');
  }


  async function loadWards(districtCode) {
    if (!districtCode) {
      document.getElementById('phuong').innerHTML = `<option value="">-- Chọn phường/xã --</option>`;
      return;
    }

    const res = await fetch(`https://provinces.open-api.vn/api/d/${districtCode}?depth=2`);
    const wards = (await res.json()).wards;

    const wardSelect = document.getElementById('phuong');
    wardSelect.innerHTML = `<option value="">-- Chọn phường/xã --</option>` + 
      wards.map(w => `<option value="${w.code}">${w.name}</option>`).join('');
  }


  function updateFullAddress() {
    const house = document.getElementById('duong').value.trim() ;
    const quan = document.getElementById('quan').selectedOptions[0]?.text || '';
    const phuong = document.getElementById('phuong').selectedOptions[0]?.text || '';

    const full = `${house} - ${phuong} - ${quan}`;
    document.getElementById('full_address').value = full;
  }

  if(document.getElementById('quan')){
    loadDistricts();
    loadWards();
    document.getElementById('quan').addEventListener('change', function (e) {
      loadWards(e.target.value);})
    document.getElementById('phuong').addEventListener('change', function (e) {
      updateFullAddress();})
  }


  //Doanh thu
document.addEventListener('DOMContentLoaded', function () {
  // const formattedLabels = chartLabels.map(dateStr => {
  //   const parts = dateStr.split('-');
  //   return `${parts[2]}/${parts[1]}/${parts[0]}`;
  // });
  const ctx = document.getElementById('myChart');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: chartLabels,
      datasets: [{
        label: 'Doanh thu (VNĐ)',
        data: chartData,
        borderColor: "#1d7af3",
              pointBorderColor: "#FFF",
              pointBackgroundColor: "#1d7af3",
              pointBorderWidth: 2,
              pointHoverRadius: 4,
              pointHoverBorderWidth: 1,
              pointRadius: 4,
              backgroundColor: "transparent",
              fill: true,
              borderWidth: 2,
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function (value) {
              return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
              }).format(value);
            }
          }
        }
      }
    }
  });


  const chartMonth = document.getElementById('chartMonth');
  new Chart(chartMonth, {
    type: 'line',
    data: {
      labels: labelsMonth,
      datasets: [{
        label: 'Doanh thu (VNĐ)',
        data: dataMonth,
        borderColor: "#1d7af3",
              pointBorderColor: "#FFF",
              pointBackgroundColor: "#1d7af3",
              pointBorderWidth: 2,
              pointHoverRadius: 4,
              pointHoverBorderWidth: 1,
              pointRadius: 4,
              backgroundColor: "transparent",
              fill: true,
              borderWidth: 2,
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function (value) {
              return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
              }).format(value);
            }
          }
        }
      }
    }
  });


  const doughnutCtx  = document.getElementById('doughnutChart');
  
  new Chart(doughnutCtx, {
    type: 'doughnut',
    data: {
      labels: productLabels,
      datasets: [{
        label: 'Tổng số lượng đã bán',
        data: productData,
        backgroundColor: colors,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'right'
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              return `${context.label}: ${context.parsed} sản phẩm`;
            }
          }
        }
      }
    }
  });
});


async function fetchTop5(){
  const response = await fetch('http://127.0.0.1:8000/api/top5');
  const result = await response.json();

  const list = document.getElementById('showKQ');
  list.innerHTML='';

  for(let sp in result){
    let item = `Nguyen Trong Phung`;
    list.innerHTML += item;
  }
}



  document.getElementById('monthSelect').addEventListener('change',async function (e) {

    const month = document.getElementById('monthSelect').value;
    const parts = month.split('-');
    const thang = parts[1];
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const response = await fetch(`http://127.0.0.1:8000/api/top5?thang=${thang}`);
      
      const result = await response.json();   
      const list = document.getElementById('showKQ');

          list.innerHTML =''; 
          if(result.spbc && result.spbc.length > 0)
         {
          //  let lastTotal = 0;
           result.spbc.forEach(item => {
              let dongiaPrice = new Intl.NumberFormat('vi-VN').format(item.dongia);
              let thanhtien = new Intl.NumberFormat('vi-VN').format(item.dongia * item.tongsoluong)
              let itemHTML = `
              <tr>
                              <td><img src="http://127.0.0.1:8000/customer/assets/img/${item.hinh}" alt=""  class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"></td>
                              <td>${item.tensanpham}</td>
                              <td>${dongiaPrice} VNĐ</td>
                              <td>${item.soluong}</td>
                              <td>${item.tongsoluong}</td>
                              <td>${thanhtien} VNĐ</td>
                          </tr>`;
              list.innerHTML += itemHTML;
              // lastTotal +=item.dongia*item.tongsoluong;
          });

          // document.getElementById('lastRow').innerHTML = `
          // <td colspan="6">
          //                   <div class="d-flex justify-content-between">
          //                       <strong>Tổng doanh thu kiếm trong tháng:</strong>
          //                       <span>${new Intl.NumberFormat('vi-VN').format(lastTotal)} VNĐ</span>
          //                   </div>
          //               </td>`;
         }
          else {
            list.innerHTML = '<tr><td colspan="6">Không có sản phẩm được bán trong tháng này.</td></tr>';
            //  document.getElementById('lastRow').innerHTML = ``;
          }
  })



  document.getElementById('warehouseForm').addEventListener('submit', function(e) {
    let input = document.getElementById('ghichu');
    if (input.text.trim() === '') {
      input.text = input.placeholder;
    }
  });