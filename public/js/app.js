function render(title, description) {
    
    let main = document.createElement('div');
    let titleContainer = document.createElement('h2');
    let descriptionContainer = document.createElement('p');

    titleContainer.textContent = `${title}`;
    descriptionContainer.textContent = `${description}`;
    main.append(titleContainer, descriptionContainer);
    titleContainer.classList.add('title');
    descriptionContainer.classList.add('description');
    main.classList.add('container');

    return document.body.appendChild(main);

}



fetch("api.php").then((response) => {
    return response.json();
}).then((json) => {render(json.title, json.description)});