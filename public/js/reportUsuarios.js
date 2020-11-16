const HOST = "http://localhost:8081/";


var urlActual = window.location;
var parameters = new URL(urlActual);
var id = parameters.searchParams.get("id");

function toggleMenu() {
  var menu = document.querySelector(".detalles");
  menu.classList.toggle("active");
}

async function getData() {  
    //getting users
    const res = await fetch(HOST + 'Presupuestos/usuarios/listarTodos');
    const data= await res.json();
    console.log(data);

    fillTable(data);

}

getData();

function fillTable(info) {
    console.log('llenando la tabla');
    console.log(info);
    const tableRow = document.getElementById('tableBody');

    info.forEach(e => {
        console.log(typeof e.SEXO);
        let sexo= e.SEXO == "1" ?'Femenino':'Masculino';

        tableRow.innerHTML += ` <tr>
                        
                <td class='v1' >${e.ID_USUARIO}</td>
                <td class='v1'>${e.NOMBRES}</td>
                <td class='v1'>${e.APELLIDOS}</td>
                <td class='v1'>${"" + e.TELEFONO}</td>
                
                <td class='v1'>${"" + e.EMAIL}</td>
                <td class='v1'>${"" + e.FECHA_CREACION}</td>
                
                <td class='v1'>${sexo}</td>
                
                
                
                <td class='v1'></td>
                
            </tr>`


    });

}
/**
 * pdf name
 */
var namePdf =
  "report" +
  new Date().getDate() +
  new Date().getMonth() +
  new Date().getFullYear() +
  new Date().getHours() +
  new Date().getMinutes() +
  new Date().getSeconds();

window.onload = function() {
  document.getElementById("cmd").addEventListener("click", () => {
    const pdf = this.document.getElementById("target");
    var options = {
      margin: 1,
      filename: namePdf,
      image: { type: "jpeg", quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: "cm", format: "letter", orientation: "portrait" }
    };
    html2pdf()
      .from(pdf)
      .set(options)
      .save();
  });
};
