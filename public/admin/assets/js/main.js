let data = []; // Khai báo biến toàn cục để lưu trữ dữ liệu

// Hàm fetch dữ liệu từ API
async function fetchNguyenlieu() {
    const response = await fetch('http://127.0.0.1:8000/api/nguyenlieu');
    const result = await response.json();
    data = result.dsnl; // Lưu dữ liệu vào biến data (giả sử dữ liệu trả về từ API là { dsnl: [...] })
}

// Hàm để thêm một dòng mới vào bảng
// Hàm để thêm một dòng mới vào bảng
function addRow() {
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
                    ${selectOptions} <!-- Các option sẽ được chèn vào đây -->
                </select>
            </td>
            <td><input name="soluong[]" class="form-control" type="number" required></td>
            <td><input name="donvitinh[]" class="form-control" required></td>
            ${showTongTien ? '<td><input name="tongtien[]" class="form-control" required></td>' : ''} <!-- Nếu cần thì hiển thị ô tổng tiền -->
            <td><button type="button" onclick="removeRow(this)" class="btn btn-danger btn-sm">-</button></td>
        </tr>
    `;

    // Thêm row vào trong bảng (giả sử có một bảng với id 'nguyenlieuTable')
    document.querySelector("#nguyenlieuTable tbody").insertAdjacentHTML('beforeend', row);
}


// Gọi hàm fetch dữ liệu khi trang tải hoặc khi cần
fetchNguyenlieu().then(() => {
    // Dữ liệu đã được fetch xong, có thể gọi addRow để thêm row vào bảng
    addRow(); // Nếu cần thêm row ngay lập tức sau khi fetch xong, uncomment dòng này
});


function removeRow(button) {
    button.closest('tr').remove();
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
