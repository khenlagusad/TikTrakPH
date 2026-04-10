const tabBtns = document.querySelectorAll(".tab");
const searchForm = document.querySelector("#search-form");
const searchInput = document.getElementById('search-input');
const errorMsg = document.getElementById("error");

let activeTab = 'plate'; // Default

function switchTab(e) {
    const id = e.target.id;

    tabBtns.forEach(t => t.classList.remove('active'));
    e.target.classList.add('active');

    if (id === 'plate-num') {
        activeTab = 'plate'
        searchInput.value = ''
        searchInput.name        = 'plate_no';
        searchInput.placeholder = 'e.g. ABC 1234';
    } else {
        activeTab = 'license'
        searchInput.value = ''
        searchInput.name        = 'license_no';
        searchInput.placeholder = 'e.g. N01-23-456789';
    }
} 
 
tabBtns.forEach((btn) => btn.addEventListener("click", switchTab));

searchForm.addEventListener('submit', (e) =>{
    e.preventDefault();

    errorMsg.style.visibility = 'hidden';
    searchInput.classList.remove('input-error');

    if (activeTab === 'plate') {
        const platePattern = /^[A-Z]{3}-\d{4}$/;
        const value = searchInput.value.trim().toUpperCase();
        
        console.log('value:', JSON.stringify(value));
        console.log('length:', value.length);
        console.log('test:', /^[A-Z]{3}-\d{4}$/.test(value));

        if (value === '') {
            errorMsg.innerHTML = 'Plate number is required!';
            errorMsg.style.visibility = 'visible';
            searchInput.classList.add('input-error');
            return;
        } else if (!platePattern.test(value)) {
            errorMsg.innerHTML = 'Invalid plate number format!';
            errorMsg.style.visibility = 'visible';
            searchInput.classList.add('input-error');
            return;
        }

    } else if (activeTab === 'license') {
        const licensePattern = /^[A-Z]\d{2}-\d{2}-\d{6}$/;
        const value = searchInput.value.trim().toUpperCase();

        if (value === '') {
            errorMsg.innerHTML = 'License number is required!';
            errorMsg.style.visibility = 'visible';
            searchInput.classList.add('input-error');
            return;
        } else if (!licensePattern.test(value)) {
            errorMsg.innerHTML = 'Invalid license number format!';
            errorMsg.style.visibility = 'visible';
            searchInput.classList.add('input-error');
            return;
        }
    }

    searchForm.submit();
});