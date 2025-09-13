function searchAddModalItems(modalId) {
    const inputField = document.getElementById('addDistName' + modalId);
    const suggestionsList = document.getElementById('itemNameSuggestions' + modalId);

    inputField.addEventListener('input', function () {
        const query = this.value;

        if (query.length > 2) { // Start searching after 3 characters
            fetch('.//classes/search_item.php?q=' + query)
                .then(response => response.json())
                .then(data => {
                    suggestionsList.innerHTML = ''; // Clear previous suggestions
                    if (data.length > 0) {
                        suggestionsList.style.display = 'block';
                        data.forEach(item => {
                            const li = document.createElement('li');
                            li.classList.add('list-group-item');
                            li.textContent = item.Item_Name;
                            li.setAttribute('data-item-id', item.Item_ID);
                            li.onclick = function () {
                                document.getElementById('addDistName' + modalId).value = item.Item_Name;
                                document.getElementById('addDistItemId' + modalId).value = item.Item_ID;
                                document.getElementById('addDistCategory' + modalId).value = item.Category_Name || 'No Category';
                                suggestionsList.style.display = 'none'; // Hide suggestions after selection
                            };
                            suggestionsList.appendChild(li);
                        });
                    } else {
                        suggestionsList.style.display = 'none';
                    }
                })
                .catch(error => console.error('Error fetching items:', error));
        } else {
            suggestionsList.style.display = 'none';
        }
    });
}

function searchEditModalItems(modalId) {
    const inputField = document.getElementById('editDistName' + modalId);  // Corrected this line
    const suggestionsList = document.getElementById('itemNameSuggestions' + modalId);

    inputField.addEventListener('input', function () {
        const query = this.value;

        if (query.length > 2) { // Start searching after 3 characters
            fetch('.//classes/search_item.php?q=' + query)
                .then(response => response.json())
                .then(data => {
                    suggestionsList.innerHTML = ''; // Clear previous suggestions
                    if (data.length > 0) {
                        suggestionsList.style.display = 'block';
                        data.forEach(item => {
                            const li = document.createElement('li');
                            li.classList.add('list-group-item');
                            li.textContent = item.Item_Name;
                            li.setAttribute('data-item-id', item.Item_ID);
                            li.onclick = function () {
                                document.getElementById('editDistName' + modalId).value = item.Item_Name;  // Corrected this line
                                document.getElementById('editDistItemId' + modalId).value = item.Item_ID;  // Corrected this line
                                document.getElementById('editDistCategory' + modalId).value = item.Category_Name || 'No Category';  // Corrected this line
                                suggestionsList.style.display = 'none'; // Hide suggestions after selection
                            };
                            suggestionsList.appendChild(li);
                        });
                    } else {
                        suggestionsList.style.display = 'none';
                    }
                })
                .catch(error => console.error('Error fetching items:', error));
        } else {
            suggestionsList.style.display = 'none';
        }
    });
}
