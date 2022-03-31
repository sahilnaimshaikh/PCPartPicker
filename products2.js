console.log("hello this is products2.js file")
// fetching the products from the json file 
// this is the temporary file which can be used to fetch the data from the json the populate the dom 

// before using this kindly modify the myCart.js file for the new structure of the div with Id('box-search');

let cpu = "";
async function getProducts(){
    const apiData = await fetch('json/cpu.json'); 
    const response = await apiData.json();
    return response;
}
let a = getProducts();
a.then(data => {
    let cpu = "";
    data.forEach(element => {
        cpu += `
                     <div class='  box shop-item' id='box-search'>
                        <img class='shop-item-image' src='https://cdna.pcpartpicker.com/static/forever/images/product/3ef757133d38ac40afe75da691ba7d60.256p.jpg' alt=''>
                        <h2 class=' shop-item-title textcenter h-secondary '>${element.name}</h2>
                        <h4 class='textcenter'>Rating: ${element.rating}(${element.rating_count})</h4>
                        <h4 class='textcenter'>Core Count: ${element.core_count}</h4>
                        <h5 class='textcenter'>Price:$${element.price_usd}</h5>
                        
                        <button type='button' class='btn btn-info addToBagButton'>Add to Bag</button>
                     </div>
        `;
        document.getElementById('service').innerHTML = cpu;
    });
}).catch("an eroor ocdured");



