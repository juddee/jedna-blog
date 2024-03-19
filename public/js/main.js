window.onload = ()=>{
    let headerSearchBtn = document.querySelector('.header-search-btn');

    headerSearchBtn.addEventListener('click', function(){
        if(headerSearchBtn.classList.contains('fa-magnifying-glass'))
        {
            headerSearchBtn.classList.remove('fa-magnifying-glass');
            headerSearchBtn.classList.add('fa-times');
        }else
        {
            headerSearchBtn.classList.remove('fa-times');
            headerSearchBtn.classList.add('fa-magnifying-glass');

        }
    });
};