const btnsId = {
    edit: 'btnEdit'
}

const baseRoute = 'http://127.0.0.1:8000/products';

const fetchAll = async (url,conf={})=>{
    try{
        const response = fetch(url,conf);
        const json = await response.json();
        return json;

    }catch(error){
        console.log(error)
    }
}

const handleEditInput = async(url,config = {},idForm)=>{
    try{
        const data = fetchAll(url,config);
        const KeysData = Object.keys(data);
        const $form = document.getElementById(idForm);

        const $inputs = $form.querySelectorAll('input[name]');


        KeysData.forEach((el,index)=>{
            let input;
            if(input = $form.querySelector(`input[name]= ${el}`)){
                
                input.value = data[el];
            }
        })

    }catch(error){
        console.log(error);
    }
}


document.addEventListener('click',e=>{

    switch(e.target.id){
        case btnsId.edit:
        const id = e.target.getAttribute('data-id');
        const route = baseRoute+`/${id}`;
        handleEditInput(route);

    }
})