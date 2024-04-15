<?php
    include "dataCreateProject.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
    <link rel="stylesheet" href="accueil.css">
    <link rel="stylesheet" href="create.css">
</head>
<body>
    <section class="create">
        <h1>Create your project</h1>
        <form action="createProject.php" method="get">
            <input type="text" name="name" placeholder="Project's name">
            <input type="text" name="target" placeholder="Target">
            <input type="date" name="deadline">
            <fieldset class="steps">
                <legend>Steps</legend>
                <div class="action">
                    <div id="add">+</div>
                    <div id="remove">-</div>
                </div>
                <div class="lsteps">
                    
                </div>
            </fieldset>
            <input type="submit" value="Create"> 
        </form>
    </section>
    <section class="navigation">
        <nav>
            <a href="createProject.php"><button>Create Project</button></a>
            <a href="project.php"><button>Project View</button></a>
        </nav>
    </section>
    <script>
        let index = 1;
        const add = document.querySelector("#add");
        const remove = document.querySelector("#remove");

        add.addEventListener("click",(event) => {
            const div = document.createElement("div");            
            let name = "step"+index;
            let prio = "prio"+index;
            let descri = "descri"+index;
            div.className = "step";
            div.innerHTML = `
                    <input type="text" name ="${name}" placeholder="Step's name">
                        <select name="${prio}">
                            <option value="">Priority</option>
                            <option value="1">Important - Urgent</option>
                            <option value="2">Less important - Urgent</option>
                            <option value="3">Less important - Less urgent</option>
                        </select>
                    <input type="textarea" name = "${descri}" placeholder="Description">
                    `;
            document.querySelector(".lsteps").append(div);
            
            index++;
        });

        remove.addEventListener("click",(event) => {
            if(index > 1) index--;
            document.querySelector(".lsteps").lastChild.remove();
        });

    </script>
</body>
</html>