const $tblPresupuesto = document.getElementById("tblPresupuesto");
const $btnGuardar=document.getElementById("btnGuardar");

let numFilas = 0;
const arr = [];
const objetoPresupuesto = {};


(() => {
    console.log("xx");
    const $btnAdd = document.getElementById("btnAdd");
    $btnAdd.addEventListener("click", () => {
        crearFila();
    })

})();

$btnGuardar.addEventListener("click",(e)=>{
    e.preventDefault();
    descripcion();

});


function descripcion() {
    const descripcionGasto = document.querySelectorAll('.descripcionGasto');

    descripcionGasto.forEach(element => {
        console.log(element.value);
    });

}


//CREANDO LA FILA 
function crearFila() {
    const $fila = document.createElement("div");
    $fila.classList.add("row");
    $fila.innerHTML = `
    <div class="col-md-4 form-group ">
                                <label>Descripcion </label>
                                <textarea class="form-control descripcionGasto " id="" rows="1"></textarea>

                                <span class="text-danger  campo-requerido"><strong></strong></span>

                            </div>


                            <div class="col-md-2 form-group ">
                         
                            </div>
                            <div class="col-md-1 form-group ">
                                <label>Unidades</label>
                                <input type="number" min="1" name="montoDisponible" id=""
                                    class="form-control montoDisponible" placeholder="$0" />
                                <span class="text-danger  campo-requerido"><strong></strong></span>
                                <br />
                            </div>
                            <div class="col-md-2 form-group ">
                                <label>Monto</label>
                                <input type="number"min="1" name="montoAsignado" id="" class="form-control"
                                    placeholder="00000000" />
                                <span class="text-danger  campo-requerido"><strong></strong></span>
                                <strong>

                                    <span class="text-danger" id="">

                                    </span>
                                </strong>
                                <br />

                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2 form-group ">
                                <label>Total</label>
                                <input disabled type="text" name="montoAsignado" id="montoAsignado" class="form-control"
                                    placeholder="00000000" />

                                <span class="text-danger  campo-requerido"><strong></strong></span>
                                <strong>
                                </strong>
                                <br />

                            </div>
                            
    `;

    $tblPresupuesto.append($fila);
    descripcion();
}