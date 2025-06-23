// Thanh cuộn lên đầu trang
$(document).ready(function () {
    $(".back-to-top").fadeOut(0);
    introJs().setOptions({
        steps:[],
        doneLabel: 'Đã hiểu',
    }).start();

    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $(".back-to-top").fadeIn("slow");
        } else {
            $(".back-to-top").fadeOut("slow"); 
        }
    });});
$(".back-to-top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 50);
    return false;
});


//Shadow cho navbar
$(window).scroll(function () {
        if ($(window).width() < 992) {
            if ($(this).scrollTop() > 55) {
                $('.fixed-top').addClass('shadow');
            } else {
                $('.fixed-top').removeClass('shadow');
            }
        } else {
            if ($(this).scrollTop() > 55) {
                $('.fixed-top').addClass('shadow');
            } else {
                $('.fixed-top').removeClass('shadow');
            }
        } 
    });


 $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });

//Tự động tuần tự các sản phẩm
$(".testimonial-carousel").owlCarousel({
    autoplay: true,
    smartSpeed: 2000,
    center: false,
    dots: true,
    loop: true,
    margin: 25,
    nav: true,
    navText: [
        '<i class="bi bi-arrow-right"></i>',
        '<i class="bi bi-arrow-left"></i>',
    ],
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
        },
        576: {
            items: 1,
        },
        768: {
            items: 1,
        },
        992: {
            items: 2,
        },
        1200: {
            items: 2,
        },
    },
});




const apiBaseUrl = "http://127.0.0.1:8000/api";

    async function loadCart() {
        const response = await fetch(apiBaseUrl);
        const cart = await response.json();
    
        const cartItem = document.getElementById('cart-item');
        cartItem.innerHTML='';
        let total =0;
        let dem = 0;
        for (let id in cart){
            const item = cart[id];
    
            let itemHTML = `<div class="cart-item d-flex align-items-center mb-3" data-id="${item.idsanpham}">
                                        <img src="http://127.0.0.1:8000/customer/assets/img/${item.hinh}" class="img-fluid rounded-circle" style="width: 50px;" alt="">
                                        <div class="ms-3">
                                            <h6 class="mb-0 " id="item-name">${item.tensanpham}</h6>
                                            <div class="d-flex justify-content-between">
                                                <span class="text-primary">${new Intl.NumberFormat('vi-VN').format(item.dongia)} VNĐ</span>
                                                <span class="text-secondary ms-3">x ${item.soluongsp}</span>
                                            </div>
                                        </div>
                                        <a onclick="handleDelete(event)" class="btn btn-sm text-danger ms-auto remove-item ">
                                            <i class="fas fa-times"></i>
                                        </a>
    
                                    </div>
                                    `;
            cartItem.innerHTML += itemHTML;
            total += item.dongia*item.soluongsp;
            dem++;
        }
        document.getElementById('total').innerHTML=`<h6>Tổng tiền:</h6>
                                        <p>${new Intl.NumberFormat('vi-VN').format(total)} VNĐ</p>`;
        document.getElementById('slsp').innerText=dem;
    };


const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
document.addEventListener('DOMContentLoaded', function() {
    let forms = document.querySelectorAll('#productForm');
    forms.forEach(form=>{
        form.addEventListener('submit', async(event)=>{
            event.preventDefault();

            let idsanpham = form.querySelector('#productId').value;
            let tensanpham = form.querySelector('#productName').innerText;
            let dongiaProduct = form.querySelector('#productPrice').innerText;
            let dongia = parseInt(dongiaProduct.replace("VNĐ","").replace(/\./g,"").trim());
            let srcHinh = form.querySelector('#productImage').src;
            let hinh = srcHinh.split('/').pop();
            let soluongsp;
            let ghichu='';
            if(form.querySelector('#productQuantity'))
                soluongsp = form.querySelector('#productQuantity').value;
            else 
                soluongsp = parseInt("1");


            const response = await fetch(`${apiBaseUrl}/add`,{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({idsanpham,tensanpham,dongia,hinh,soluongsp,ghichu}),
                mode: 'cors',
            });

            const result = await response.json();
            alert(result.message);
        });
    });
});


//ListCard

async function loadListCart() {
    const response = await fetch(apiBaseUrl);
    const cart = await response.json();

    const cartItem = document.getElementById('listCart');
    cartItem.innerHTML = '';
    let tongtien = 0;
    let dem = 0;
    let soluong=0;
    
    for (let id in cart) {
        const item = cart[id];
        
        let itemHTML= `<tr class="cart-item" data-id="${item.idsanpham}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input type="hidden" value="${item.idsanpham}" id="item-id"/>
                                        <img src="http://127.0.0.1:8000/customer/assets/img/${item.hinh}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" id="item-name">${item.tensanpham}</p>
                                </td>
                                <td>
                                    <textarea class="mt-2" data-id="${item.idsanpham}" style="width:100%; border-radius:8px;" onblur="handleQuantityChange(event, ${item.idsanpham})" >${item.ghichu || 'Đầy đủ'}</textarea>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">${new Intl.NumberFormat('vi-VN').format(item.dongia)} VNĐ</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border" onclick="handleQuantityChange(event,${item.idsanpham})">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input id="product-quantity-${item.idsanpham}" type="text" class="form-control form-control-sm text-center border-0" value="${item.soluongsp}">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border" onclick="handleQuantityChange(event,${item.idsanpham})">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">${new Intl.NumberFormat('vi-VN').format(item.dongia*item.soluongsp)} VNĐ</p>
                                </td>
                                <td>
                                    <a onclick="handleDelete(event)">
                                    <button class="btn btn-md rounded-circle bg-light border mt-4">
                                     <i class="fa fa-times text-danger"></i>
                                    </button>
                                    </a>
                                </td>  
                            </tr>
                                `;
        cartItem.innerHTML += itemHTML;
        tongtien += item.dongia*item.soluongsp;
        dem++;
        soluong += item.soluongsp;
    }
    let VND = new Intl.NumberFormat('vi-VN').format(tongtien);
    document.getElementById("lastTotal").innerHTML = `<h5 class="mb-0 ps-4 me-4">Tổng tiền</h5>
                                <p class="mb-0 pe-4">${VND} VNĐ</p>`
    document.getElementById("quantity").innerHTML = `<h5 class="mb-0 ps-4 me-4">Số lượng bánh</h5>
                                <p class="mb-0 pe-4">${soluong} cái</p>`
    document.getElementById("loaibanh").innerHTML = `<h5 class="mb-0 ps-4 me-4">Số loại bánh</h5>
                                <p class="mb-0 pe-4">${dem} loại</p>`
}
if(document.getElementById('listCart')){
    loadListCart();
}


//Update api
async function handleQuantityChange(event,idsanpham) {
    let quantity = document.querySelector(`#product-quantity-${idsanpham}`).value;
    let note = document.querySelector(`textarea[data-id="${idsanpham}"]`).value;
    if(note == null)
        note = 'Đầy đủ';
    if (event.target.closest('button')) {
        const button = event.target.closest('button');
        const quantityInput = button.closest('.quantity').querySelector(`#product-quantity-${idsanpham}`);
        quantity = parseInt(quantityInput.value, 10);
        if (button.classList.contains('btn-plus')) {
            quantity += 1;
        } else if (button.classList.contains('btn-minus')) {
            if (quantity > 1) {
            quantity -= 1;
        }
        }
        quantityInput.value = quantity;
    }

    const response = await fetch(`${apiBaseUrl}/update/${idsanpham}`, {
        method: 'PUT',
        headers: { 
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({ quantity, note }),
        mode: 'cors',
    });
    const result = await response.json();
    loadListCart(); 
}


//Delete api
function handleDelete(event) {
    event.preventDefault(); 
    
    const cartItem = event.target.closest('.cart-item');

    const id = cartItem.getAttribute('data-id');
    const name = cartItem.querySelector('#item-name').innerText;

    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm '+name+' khỏi giỏ hàng không?')) {
        fetch(`${apiBaseUrl}/delete/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => {
            if (response.ok) {
                alert('Xóa thành công!');
                loadCart();
                if(document.getElementById("listCart"))
                    loadListCart();
            }})
    }
}

function test(event){
    event.preventDefault();
    alert('123');
}


