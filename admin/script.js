setTimeout(() => {
    const toast = document.querySelector('.toast');
    if(toast){
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 1000);
    }
}, 3000); // disappears after 3 sec


