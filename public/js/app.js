fetch("api.php").then((response) => {
    return response.json();
}).then((json) => { console.log(json) });