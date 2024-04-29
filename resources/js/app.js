import "./bootstrap";
import "~resources/scss/app.scss";
import "alpinejs";
import * as bootstrap from "bootstrap";

import.meta.glob(["../img/**", "../fonts/**"]);

// Toggle the side navigation

const sidebarToggle = document.body.querySelector("#sidebarToggle");
if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    //     document.body.classList.toggle('sb-sidenav-toggled');
    // }
    sidebarToggle.addEventListener("click", (event) => {
        event.preventDefault();

        document.body.classList.toggle("sb-sidenav-toggled");
        localStorage.setItem(
            "sb|sidebar-toggle",
            document.body.classList.contains("sb-sidenav-toggled")
        );
    });
}


//modale
const deleteSubmitButtons = document.querySelectorAll(".delete-button");

deleteSubmitButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
        event.preventDefault();

        const dataTitle = button.getAttribute("data-item-title");

        const modal = document.getElementById("deleteModal");

        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();

        const modalItemTitle = modal.querySelector("#modal-item-title");
        modalItemTitle.textContent = dataTitle;

        const buttonDelete = modal.querySelector("button.btn-primary");

        buttonDelete.addEventListener("click", () => {
            button.parentElement.submit();
        });
    });
});

document.addEventListener('livewire:load', function () {
    Livewire.on('confirm-delete', clientId => {
        $('#confirmDeleteModal').modal('show');
    });
    Livewire.on('clientDeleted', () => {
        $('#confirmDeleteModal').modal('hide');
    });
});

window.addEventListener('show-delete-modal',event =>{
    $('#confirmationModal').modal('show');
})

const xValues = ["Brown-Hodkiewicz", "Lang, Nolan and Mertz", "McKenzie, Farrell and Reichert", "Harber Group", "Wyman-Waters"];
const yValues = [946.47, 1309.48, 946.53, 634.42, 561.98];
const barColors = ["red", "green","blue","orange","brown"];
const backgroundColor =["trasparent"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Miglior fatturato 2022"
    },
  }
});


new Chart("myAreaChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Miglior fatturato 2022"
    },
  }
});

new Chart("myPieChart", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      title: {
        display: true,
        text: "Miglior fatturato 2022"
      }
    }
  });
