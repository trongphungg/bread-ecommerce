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


$(".vegetable-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-right"></i>',
            '<i class="bi bi-arrow-left"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            },
            1200:{
                items:4
            }
        }
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


//ListCart

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

// API Google
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

function test(event){
    event.preventDefault();
    alert('123');
}




document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('#star-rating .star');
    const scoreInput = document.getElementById('sodiem');

    stars.forEach(star => {
      star.addEventListener('click', function () {
        const selected = parseInt(this.getAttribute('data-value'));
        scoreInput.value = selected;
        stars.forEach(s => {
          const val = parseInt(s.getAttribute('data-value'));
          if (val <= selected) {
            s.classList.remove('text-muted');
            s.classList.add('text-warning'); 
          } else {
            s.classList.remove('text-warning');
            s.classList.add('text-muted'); 
          }
        });
      });
    });
  });



  //SearchProducts
function searchProducts(query) {
    let url = 'search-products?query='+(query ? query :'');
    fetch(url) 
        .then(response => response.json())
        .then(data => {
            let productList = document.getElementById('showProducts');
            productList.innerHTML = ''; 

            data.data.forEach(product =>{
                let truncatedText = product.motasanpham.slice(0, 70)+'...';
                let amount = product.dongia; 
                let VND = new Intl.NumberFormat('vi-VN').format(amount);
                let productHTML = `
                                                 <div class="col-md-6 col-lg-6 col-xl-4 ">
                                                        <div class="rounded position-relative fruite-item">
                <div class="fruite-img">
                                               <img src="customer/assets/img/${product.hinh}" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="p-4 border border-top-0 rounded-bottom">
                                                <h4>${product.tensanpham}</h4>
                                                <p class="green-color">${truncatedText}</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-6 fw-bold mb-0">${VND} VNĐ</p>
                                                    <a onclick="addCart('${product.idsanpham}','${product.tensanpham}','${product.dongia}','1','${product.hinh}')" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-1 text-primary"></i> Thêm vào giỏ</a>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                            
                `;
                productList.innerHTML += productHTML;
            });
        })
        .catch(error => console.error('Error fetching products:', error));
}


//Search when input

const searchInput = document.getElementById('search-input')
if(searchInput){
    searchInput.addEventListener('input',()=>{
    let query = document.getElementById('search-input').value;
    searchProducts(query);
})
}

//Search when click
const searchClick = document.querySelectorAll('.category-item');
if(searchClick){
    searchClick.forEach(category=>{
    category.addEventListener('click',()=>{
        let categoryId= category.getAttribute('data-product-id');
        searchProducts(categoryId);
    })
})
}

//Add Cart
async function addCart(idsanpham,tensanpham,dongia,soluongsp,hinh){
    const response = await fetch(`${apiBaseUrl}/add`, {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({ idsanpham, tensanpham, dongia, soluongsp, hinh }),
        mode: 'cors',
    });

    const result = await response.json();
    alert(result.message);
    loadCart();
}