'use strict';

window.addEventListener("DOMContentLoaded",()=>{
	const button = document.querySelector('.form__button'),
          inputFrom = document.querySelector('#cur_from input'),
          inputTo = document.querySelector('#cur_to input');
    let   curFrom = document.querySelector('#cur_from select option[selected]').value,
          curTo = document.querySelector('#cur_to select option[selected]').value;

	button.addEventListener('click',(e)=>{
		e.preventDefault();

		let request = BX.ajax.runComponentAction('vosko:rates.nbrb', 'send', {
				mode:'class',
				data: {
					curFrom:  curFrom,
					valFrom: inputFrom.value,
					curTo: curTo,
					valTo: inputTo.value
				}
		});
		request.then(function(response){
            const result = JSON.parse(JSON.stringify(response));
            console.log(result);
			console.log(result.data.newValue);
            inputTo.value=result.data.newValue;

		});

	});

    function getDynamicInput(selector,tag) {
        switch(tag) {
            case "input":
            const input = document.querySelector(selector);
            input.addEventListener('input', () => {
                input.value=input.value;
             });
                break;
            case "select1":
            const select = document.querySelector(selector);
            select.addEventListener('change', (e) => {
                curFrom = select.value;
             });
                break;
            case "select2":
            const select2 = document.querySelector(selector);
               select2.addEventListener('change', (e) => {
                 curTo = select2.value;
               });
                 break;              
        }

    }
    
    getDynamicInput('#cur_from input','input');
    getDynamicInput('#cur_to input','input');
    getDynamicInput('#cur_from select','select1');
    getDynamicInput('#cur_to  select','select2');

});