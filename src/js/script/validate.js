const validate = function () {
    const form = document.querySelector('.forms');
    const inputs = document.querySelectorAll('.forms-group__input');
    const message = {
        loading: 'Загрузка...',
        success: 'Спасибо! Скоро мы с Вами свяжемся.',
        error: 'Что то пошло не так...',
    };

    function validateForm(elem) {
        let error = true;
        if(elem){
            elem.forEach(item => {
                if(item.value === ''){
                    item.style.borderColor = 'red';
                    error = false;
                }
            });
            return error;
        }
    }

    function clearInput(elem){
        elem.forEach(item => {
            item.value = '';
        })
    }

    document.addEventListener('focusout', (ev) => {
        const target = ev.target;

        if(target && target.matches('.forms-group__input')){
            if(!target.value){
                target.style.borderColor = '#dc143c';
            } else {
                target.removeAttribute('style');
            }
        }
    });

    const postData = async (url, data) => {
        document.querySelector('.submit').textContent = message.loading;
        let res = await fetch(url, {
            method: 'POST',
            body: data,
        });
        if(!res.ok){
            throw new Error(`Что то ${url}, и не то ${res.status}`)
        }
        return await res.text();
    };

    document.addEventListener('submit', ev => {
       const target = ev.target;

       if(target && target.classList.contains('forms')){
           ev.preventDefault();

           const send = document.querySelector('.submit');
           const block = document.querySelector('.form');
           const formData = new FormData(form);

           if(validateForm(inputs)){
               postData('index.php', formData)
                   .then(() => {
                   })
                   .then(res => {
                       //console.log(res);
                       send.textContent = message.success;
                   }).catch(() => send.textContent = message.error)
                   .finally(() => {
                       clearInput(inputs);
                       setTimeout(() => {
                           document.querySelector('.form').remove();
                       }, 5000);
                   })
           }
       }
    })
};

export default validate;
