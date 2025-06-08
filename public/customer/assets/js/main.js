// Thanh cuộn lên đầu trang
$(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $(".back-to-top").fadeIn("slow");
    } else {
        $(".back-to-top").fadeOut("slow");
    }
});
$(".back-to-top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
    return false;
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

        let itemHTML = `<div class="cart-item d-flex align-items-center mb-3">
                                    <img src="http://127.0.0.1:8000/assets/img/${item.hinh}" class="img-fluid rounded-circle" style="width: 50px;" alt="">
                                    <div class="ms-3">
                                        <h6 class="mb-0">${item.tensanpham}</h6>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-primary">${item.dongia}VND</span>
                                            <span class="text-secondary ms-3">x ${item.soluongsp}</span>
                                        </div>
                                    </div>
                                <button class="btn btn-sm text-danger ms-auto remove-item ">
                                    <input type="hidden" value="${item.idsanpham}" id="item-id"/>
                                    <a href="#" onclick="handleDelete(event)"><i class="fas fa-times"></i></a>
                                </button>

                                </div>
                                `;
        cartItem.innerHTML += itemHTML;
        total += item.dongia*item.soluongsp;
        dem++;
    }
    document.getElementById('total').innerHTML=`<h6>Total:</h6>
                                    <h6>${total}</h6>`;
    document.getElementById('slsp').innerText=dem;
}

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
            if(form.querySelector('#productQuantity'))
                soluongsp = form.querySelector('#productQuantity').value;
            else 
                soluongsp = 1;


            const response = await fetch(`${apiBaseUrl}/add`,{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({idsanpham,tensanpham,dongia,hinh,soluongsp}),
                mode: 'cors',
            });

            const result = await response.json();
            alert(result.message);
        });
    });
});