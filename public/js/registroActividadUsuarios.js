(()=>{

var currentdate = new Date(); 
var datetime = "Last Sync: " +currentdate.getFullYear()  + "-"
                + (currentdate.getMonth()+1)+ "-" 
                +  currentdate.getDate() + " "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();
console.log(datetime);
})();

/*SELECT * FROM (
   SELECT * FROM yourTableName ORDER BY id DESC LIMIT 10
)Var1
   ORDER BY id ASC;*/