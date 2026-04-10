const plateSelect     = document.querySelector("#plate_number");
const licenseField    = document.querySelector("#license_number");
const violationSelect = document.querySelector("#violation_type");
const enforcerSelect  = document.querySelector("#enforcer");
const citySelect      = document.querySelector("#city");
const issueForm       = document.querySelector("#issue-form");

plateSelect.addEventListener("change", () => {
  const opt = plateSelect.options[plateSelect.selectedIndex];
  licenseField.value = opt.getAttribute("data-license") || "";
});

issueForm.addEventListener("submit", (e) => {
  const checks = [
    { field: plateSelect,     id: "error-plate",     msg: "Please select a plate number." },
    { field: violationSelect, id: "error-violation", msg: "Please select a violation type." },
    { field: enforcerSelect,  id: "error-enforcer",  msg: "Please select an enforcer." },
    { field: citySelect,      id: "error-city",      msg: "Please select a city." },
  ];

  let valid = true;
  checks.forEach(({ field, id, msg }) => {
    const err = document.querySelector(`#${id}`);
    if (!field.value) {
      e.preventDefault();
      field.classList.add("input-error");
      err.textContent = msg;
      valid = false;
    } else {
      field.classList.remove("input-error");
      err.textContent = "";
    }
  });
});

[plateSelect, violationSelect, enforcerSelect, citySelect].forEach(sel => {
  sel.addEventListener("change", () => {
    sel.classList.remove("input-error");
    const map = {
      plate_number:   "error-plate",
      violation_type: "error-violation",
      enforcer:       "error-enforcer",
      city:           "error-city",
    };
    const err = document.querySelector(`#${map[sel.id]}`);
    if (err) err.textContent = "";
  });
});