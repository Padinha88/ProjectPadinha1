
//Cria um carrinho de compras em JavaScript 
"use strict";                        
let cart = [];
let cartTotal1Dia = 0;
let cartTotal = 0;
let dias = 1;
const cartDom = document.querySelector(".cart");
const addtocartbtnDom = document.querySelectorAll('[data-action="add-to-cart"]');

addtocartbtnDom.forEach(addtocartbtnDom => {
  addtocartbtnDom.addEventListener("click", () => {
    const productDom = addtocartbtnDom.parentNode.parentNode;
    const product = {
      img: productDom.querySelector(".product-img").getAttribute("src"),
      name: productDom.querySelector(".product-name").innerText,
      price: productDom.querySelector(".product-price").innerText,
      quantity: 1
  };

// Verifica se um produto já está no carrinho e, se não estiver
//,adiciona-o ao carrinho com opções para aumentar, diminuir ou remover o item.
  
const IsinCart = cart.filter(cartItem => cartItem.name === product.name).length > 0;
if (IsinCart === false) {
  cartDom.insertAdjacentHTML("beforeend",`
    <div class="d-flex flex-row shadow-sm card cart-items mt-2 mb-3 animated flipInX">
    <div class="p-2">
        <img src="${product.img}" alt="${product.name}" style="max-width: 50px;"/>
    </div>
    <div class="p-2 mt-3">
        <p class="text-white cart_item_name">${product.name}</p>
    </div>
    <div class="p-2 mt-3">
        <p class="text-white cart_item_price">${product.price}</p>
    </div>
    <div class="p-2 mt-3 ml-auto">
        <button class="btn badge badge-success" type="button" data-action="decrease-item">&minus;</button>
    </div>
    <div class="p-2 mt-3">
        <p class="text-white cart_item_quantity">${product.quantity}</p>
    </div>
    <div class="p-2 mt-3">
        <button class="btn badge badge-success" type="button" data-action="increase-item">&plus;</button>
    </div>
    <div class="p-2 mt-3">
    <button class="btn badge badge-success" type="button" data-action="remove-item">&times;</button>
</div>
</div>`);


//Atualiza o carrinho de compras, calculando o total e permitindo aumentar a
//quantidade de itens, enquanto também fornece opções para limpar o carrinho 
//e efetuar o checkout.

  if(document.querySelector('.cart-footer') === null){
    cartDom.insertAdjacentHTML("afterend",  `
    <div class="tudo">
        <div class="d-flex flex-row shadow-sm card cart-footer mt-2 mb-3 animated flipInX">
        <div class="p-2">
          <button class="btn badge-success" type="button" data-action="clear-cart">Limpar</button>
        </div>
        <div class="p-2 ml-auto">
          <button class="btn btn-success" type="button" data-action="check-out">Submeter <span class="pay"></span> 
          &#10137;
        </button>
        </div>
          </div>
        </div>`); }

    addtocartbtnDom.innerText = "No carrinho";
    addtocartbtnDom.disabled = true;
    cart.push(product);

    const cartItemsDom = cartDom.querySelectorAll(".cart-items");
    cartItemsDom.forEach(cartItemDom => {

    if (cartItemDom.querySelector(".cart_item_name").innerText === product.name) {

      cartTotal1Dia += parseInt(cartItemDom.querySelector(".cart_item_quantity").innerText) 
      * parseInt(cartItemDom.querySelector(".cart_item_price").innerText) ;
      cartTotal= cartTotal1Dia*dias;
      document.querySelector('.pay').innerText = cartTotal + "€";

      // Aumenta o item no carrinho
      cartItemDom.querySelector('[data-action="increase-item"]').addEventListener("click", () => {
        cart.forEach(cartItem => {
          if (cartItem.name === product.name) {
            cartItemDom.querySelector(".cart_item_quantity").innerText = ++cartItem.quantity;
            cartItemDom.querySelector(".cart_item_price").innerText = parseInt(cartItem.quantity) *
            parseInt(cartItem.price) + "€";
            cartTotal1Dia += parseInt(cartItem.price) ;
            cartTotal= cartTotal1Dia*dias;
            document.querySelector('.pay').innerText = cartTotal + "€";
          }
        });
      });

      
// Diminui o item no carrinho
      cartItemDom.querySelector('[data-action="decrease-item"]').addEventListener("click", () => {
        cart.forEach(cartItem => {
          if (cartItem.name === product.name) {
            if (cartItem.quantity > 1) {
              cartItemDom.querySelector(".cart_item_quantity").innerText = --cartItem.quantity;
              cartItemDom.querySelector(".cart_item_price").innerText = parseInt(cartItem.quantity) *
              parseInt(cartItem.price) + "€";
              cartTotal1Dia -= parseInt(cartItem.price)
              cartTotal= cartTotal1Dia*dias;
              document.querySelector('.pay').innerText = cartTotal + "€";
            }
          }
        });
      });


// remover item do carrinho
      cartItemDom.querySelector('[data-action="remove-item"]').addEventListener("click", () => {
        cart.forEach(cartItem => {
          if (cartItem.name === product.name) {
              cartTotal1Dia -= parseInt(cartItemDom.querySelector(".cart_item_price").innerText);
              cartTotal= cartTotal1Dia*dias;
              document.querySelector('.pay').innerText = cartTotal + "€";
              cartItemDom.remove();
              cart = cart.filter(cartItem => cartItem.name !== product.name);
              addtocartbtnDom.innerText = "Add to cart";
              addtocartbtnDom.disabled = false;
          }
          if(cart.length < 1){
            document.querySelector('.cart-footer').remove();
          }
        });
      });


// limpar carrinho
      document.querySelector('[data-action="clear-cart"]').addEventListener("click" , () => {
        cartItemDom.remove();
        cart = [];
        cartTotal1Dia = 0;
        cartTotal = 0;
        if(document.querySelector('.cart-footer') !== null){
          document.querySelector('.cart-footer').remove();
        }
        addtocartbtnDom.innerText = "Add to cart";
        addtocartbtnDom.disabled = false;
      });

      document.querySelector('[data-action="check-out"]').addEventListener("click" , () => {
        if(document.getElementById('pedido-form') === null){
          checkOut();
        }
      });
    }
  });
}
});
});


function checkOut() {
  let pedidoHTMLForm = `
  <form id="pedido-form" action="pedido.php" method="get">
    <input type="hidden" name="lev" value="${document.getElementById("txtDate1").value}">
    <input type="hidden" name="dev" value="${document.getElementById("txtDate2").value}">
    <input type="hidden" name="m" value="${document.getElementById("mensagem").value}">
    <input type="hidden" name="total" value="${cartTotal}">
  `;
   
  cart.forEach((cartItem,index) => {
   ++index;
   let preco=cartItem.price.replace("€","")
   preco=preco.replace("+","")
   
   pedidoHTMLForm += ` <input type="hidden" name="tipBic_${index}" value="${cartItem.name}">
    <input type="hidden" name="prUnit_${index}" value="${preco}">
    <input type="hidden" name="quanti_${index}" value="${cartItem.quantity}">`;
  });
   
  pedidoHTMLForm += `<input type="submit" value="pedido" class="pedido">
  </form>
  
  <div class="overlay">Please wait...</div>`;
  document.querySelector('body').insertAdjacentHTML("beforeend", pedidoHTMLForm);
  document.getElementById("pedido-form").submit();
}


function animateImg(img) {
  img.classList.add("animated","shake");
}


function normalImg(img) {
  img.classList.remove("animated","shake");
}






/* código para os dias da reserva */
function dias_reserva(dias_reserva) {

    if (dias_reserva>0) {
      dias=dias_reserva;
      document.getElementById("dias_alug").style.visibility="visible";  //pode ser necessário                        
      document.getElementById("dias_a").innerHTML = dias + " dia";
      
      /* atualizar o preço total */
          cartTotal = cartTotal1Dia * dias;
          document.querySelector('.pay').innerText = cartTotal + "€";
      


      if(dias_reserva>1) {
          document.getElementById("dias_a").innerHTML+="s";
      }
    }

    else {
      document.getElementById("dias_alug").style.visibility="hidden";
      dias=1;


      /* atualizar o preço total */
         document.querySelector('.pay').innerText = cartTotal + "€";

    }
}



function data_alterada(e,inicio){

  let dia_ini,mes_ini, ano_ini, dia_fim, mes_fim, ano_fim, dia_escolhido;

  let hoje = new Date();
  hoje.setHours(0, 0, 0, 0); // põe horas, minutos e segundos a 0 

  if(inicio) {
    let d = new Date( e.target.value );

    
    if (hoje > d.getTime() ) {
      alert("A data introduzida é anterior à data de hoje."); 
      document.getElementById("txtDate1").value = "";
    }

    let d2 = new Date(document.getElementById('txtDate2').value);

    let dif_tempo = d2.getTime() - d.getTime();  
    let dias_r = dif_tempo / (1000 * 60 * 60 * 24);
    if(dias_r<=0) {
      alert("A data de levantamento deve ser anterior à data de devolução."); 
      document.getElementById("txtDate1").value = ""; 
    }
    
    dias_reserva(dias_r);
  }

  else {
    let d2 = new Date( e.target.value );
    
    if (hoje > d2.getTime()) {
      alert("A data introduzida é anterior à data de hoje."); 
      document.getElementById("txtDate2").value = "";
    }
    else if (hoje >  d2.getTime() - (1000 * 60 * 60 * 24)) {
      alert("A data de devolução não pode ser hoje."); 
      document.getElementById("txtDate2").value = "";      
    }
    
    let d = new Date(document.getElementById('txtDate1').value);

    let dif_tempo = d2.getTime() - d.getTime();  
    let dias_r = dif_tempo / (1000 * 60 * 60 * 24);
    if(dias_r<=0) {
      alert("A data de devolução deve ser posterior à data de levantamento."); 
      document.getElementById("txtDate2").value = ""; 
    }

    
    dias_reserva(dias_r);
  }
  

}
