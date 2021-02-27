const form = function (elem) {
    const block = document.querySelector(elem);

    function _close(elem, block = 'none'){
        if(elem){
            elem.style.display = block;
        }
    }

    document.addEventListener('click', (ev) => {
        const target = ev.target;
        if(target && target.classList.contains('open')){
            _close(block, 'flex')
        }

        if(target && target.classList.contains('closed')){
            _close(block)
        }

        if (target === block){
            _close(block)
        }
    });

    document.addEventListener('keydown', ev => {
        if(ev.code === "Escape"){
            _close(block)
        }
    });
};


export default form;
