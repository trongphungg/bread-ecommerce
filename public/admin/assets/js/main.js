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
    if (!table) return;
  const currentPage = window.location.pathname;
  const showTongTien = currentPage.includes('warehouse');

    const selectOptions = data.map(item => {
        return `<option value="${item.idnguyenlieu}" data-donvi="${item.donvitinh}">${item.tennguyenlieu}</option>`; // Tạo option từ id và name của nguyên liệu
    }).join('');

    const row = `
        <tr>
            <td>
                <select name="idnguyenlieu[]" class="form-control nguyenlieu-select" required>
                    <option value="">-- Chọn nguyên liệu --</option>
                    ${selectOptions}
                </select>
            </td>
            <td><input name="soluong[]" class="form-control" type="number" required></td>
            <td><input name="donvitinh[]" class="form-control" required readonly></td>
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



 document.addEventListener('DOMContentLoaded', function () {
    const monthSelect = document.getElementById('monthSelect');
    if (!monthSelect) return;

    monthSelect.addEventListener('change', async function () {
        const month = this.value;
        const parts = month.split('-');
        const thang = parts[1];

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        try {
            const response = await fetch(`http://127.0.0.1:8000/api/top5?thang=${thang}`, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            });

            const result = await response.json();
            const list = document.getElementById('showKQ');
            if (!list) return;

            list.innerHTML = '';

            if (result.spbc && result.spbc.length > 0) {
                result.spbc.forEach(item => {
                    const dongiaPrice = new Intl.NumberFormat('vi-VN').format(item.dongia);
                    const thanhtien = new Intl.NumberFormat('vi-VN').format(item.dongia * item.tongsoluong);
                    const itemHTML = `
                        <tr>
                            <td><img src="http://127.0.0.1:8000/customer/assets/img/${item.hinh}" alt="" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"></td>
                            <td>${item.tensanpham}</td>
                            <td>${dongiaPrice} VNĐ</td>
                            <td>${item.tongsoluong}</td>
                            <td>${thanhtien} VNĐ</td>
                        </tr>`;
                    list.innerHTML += itemHTML;
                });
            } else {
                list.innerHTML = '<tr><td colspan="6">Không có sản phẩm được bán trong tháng này.</td></tr>';
            }
        } catch (error) {
            console.error('Lỗi khi fetch dữ liệu top5:', error);
        }
    });
});




 document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('warehouseForm');
    if (form) {
        form.addEventListener('submit', function (e) {
            const input = document.getElementById('ghichu');
            if (input && input.value.trim() === '') {
                input.value = input.placeholder;
            }
        });
    }
});


  //Toast
function toast({
    title = '',
    message = '',
    type = 'info',
    duration = 3000
}) {
    const main = document.getElementById('toast');
    if (main) {
        const toast = document.createElement('div');
        const AutoRemoveId = setTimeout(function () {
            main.removeChild(toast);
        }, duration + 1000);

        toast.onclick = function (e) {
            if (e.target.closest('.toast__close')) {
                main.removeChild(toast);
                clearTimeout(AutoRemoveId);
            }
        };

        const icons = {
            success: 'fas fa-check-circle',
            info: 'fas fa-info-circle',
            warning: 'fas fa-exclamation-circle',
            error: 'fas fa-exclamation-circle'
        };
        const icon = icons[type];
        const delay = (duration / 1000).toFixed(2);
        toast.classList.add('toast', `toast--${type}`);
        toast.style.animation = `slideInLeft ease .3s, fadeOut linear 1s ${delay}s forwards`;

        toast.innerHTML = `
            <div class="toast__icon">
                <i class="${icon}"></i>
            </div>
            <div class="toast__body">
                <h3 class="toast__title">${title}</h3>
                <p class="toast__msg">${message}</p>
            </div>
            <div class="toast__close">
                <i class="fa-regular fa-circle-xmark"></i>
                <i class="bi bi-x-square-fill"></i>
            </div>
        `;

        main.appendChild(toast);
        setTimeout(() => {
            toast.classList.add('show');
        }, 100);
    }
}

function showSuccessToast(message) {
    toast({
        title: 'Thành công',
        message: message,
        type: 'success',
        duration: 5000
    });
}

function showErrorToast(message) {
    toast({
        title: 'Thất bại',
        message: message,
        type: 'error',
        duration: 5000
    });
}