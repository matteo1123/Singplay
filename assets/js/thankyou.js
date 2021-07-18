setTimeout(()=> {
    if(window.location.pathname.includes('cancelled')){
        window.location.href=window.location.origin + "/welcome-back";
    } else {
        window.location.href=window.location.origin + "/sarahs-corner";
    }
 }, 3000)