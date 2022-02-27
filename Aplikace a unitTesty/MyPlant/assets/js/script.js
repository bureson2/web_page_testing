function theme(){
    //Get changing button
    const toggleTheme = document.querySelector('.toggle-theme');
    //Get html tag
    let el = document.documentElement

    toggleTheme.addEventListener('click', () => {
        //Remove dark-theme attribute if it is in localStorage
        if(el.hasAttribute('data-theme')) {
            el.removeAttribute('data-theme')
            localStorage.removeItem('theme')
        } else {
            //Set dark-theme attribute to localStorage
            el.setAttribute('data-theme', 'dark')
            localStorage.setItem('theme', 'dark')
        }
    })

    if(localStorage.getItem('theme') !== null) {
        el.setAttribute('data-theme', 'dark')
    }
}

theme()