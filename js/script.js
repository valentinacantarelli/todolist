// stampare in pagina un item per ogni elemento contenuto in un array
// - ogni item ha una "x" associata: cliccando su di essa, l'item viene rimosso dalla lista
// - predisporre un input per aggiungere un nuovo item alla lista: digitando il tasto invio oppure ciccando su un pulsante, il testo digitato viene aggiunto alla lista

const app=new Vue(
    {
        el:"#root",
        data:{
            toDos:["Fare la spesa","Lavare i piatti","Ballare in cucina","Scrivere un racconto"],
            newToDo:"",

        },
        methods:{
            addTodo:function(){
                if(this.newToDo != ""){
                    this.toDos.push(this.newToDo);
                    this.newToDo="";
                }
            },
            remove:function(toDoIndex){
                this.toDos.splice(toDoIndex,1);
            }

        }
    }
);
