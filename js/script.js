
const app=new Vue(
    {
        el:"#root",
        
        methods:{
            addTodo:function(){
                if(this.newToDo != ""){
                    this.toDos.push(this.newToDo);
                    this.newToDo="";
                }
            },
            remove:function(toDoIndex){
                this.toDos.splice(toDoIndex,1);
            },
            completed:function(toDo){
                return "done";
                
            },
            pizza:function(todo){
                const id = this.id;
                alert(id);
            }

        }
    }
);
