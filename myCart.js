console.log("hello i am in myCart.js file")


let addToBagButton = document.getElementsByClassName("addToBagButton");
// console.log(addToBagButton)
// addToBagButton.addEventListener('click',addToBag(){
//     console.log("hello this is addto bag function")
// });

function goToCart(productName,productPrice,productCode,productImgSrc){
    let product = {
        productName : productName,
        productPrice : productPrice,
        productCode : productCode,
        productImgSrc : productImgSrc
    }
    let products = localStorage.getItem('products');
    if(products == null){
        productsArray = []
    }
    else{
        productsArray = JSON.parse(products);
    }
    productsArray.push(product);

    localStorage.setItem('products',JSON.stringify(productsArray));
    // console.log('clicked',product);
}


Array.from(addToBagButton).forEach((e,index)=>{
    e.addEventListener('click',()=>{
        // console.log("add to bag button clicked on"+(index+1))
        let productName = e.parentNode.children[1].innerText;
        // console.log(productName)
        let productPrice = e.parentNode.children[3].innerText.slice(7);
        // console.log(productPrice)
        let productCode = e.parentNode.children[4].innerText.slice(14);
        let productImgSrc = e.parentNode.children[0].src;
        
        console.log(productName,productPrice,productCode,productImgSrc)
        goToCart(productName,productPrice,productCode,productImgSrc);
    });
})

