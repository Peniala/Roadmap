<?php
    include "dataProject.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link rel="stylesheet" href="accueil.css">
    <link rel="stylesheet" href="projectview.css">
</head>
<body>
    <section class="view">
        <h1>Lists of Projects</h1>
       <?php
            foreach($projects as $i => $p){
                if($i > 0){
                $steps = listeSteps($p['id_project']);
                $nb = countStep($p['id_project']);
                $done = countStepDone($p['id_project']);
                $progress = ($done * 100)/$nb;

                ?>
                <fieldset class="projects">
                    <legend class="title"><?php echo $p['name'];?></legend>
                    <div>Target : <?php echo $p['target']; ?></div>
                    <div>Deadline : <?php echo $p['deadline'];?></div>
                    <fieldset>
                        <legend>Steps</legend>
                    <?php
                        foreach($steps as $j => $s){
                            if($j > 0){
                            ?>
                            <form action="project.php" method="get" class="formStep">
                                <div class="<?php echo "prio".$s['priority'];?>">
                                    <input type="text" name="step" value="<?php echo $s['id_step'];?>" hidden>
                                    <input type="checkbox" name="stat" <?php verifyDone($s['status']);?>>
                                    <h3> Step<?php echo $j;?> : <?php echo $s['name'];?></h3>
                                    <p>Description : <?php echo $s['descri'];?></p>
                                    <h4><?php getPriority($s['priority']);?></h4>
                                </div>
                                <input type="submit" value="Done">
                            </form>
                            
                        <?php }
                        }
                    ?>
                    </fieldset>
                    <fieldset>
                        <legend>Progress : <?php echo (int)$progress;?>%</legend>
                        <div id="progress" style="width: <?php echo $progress;?>%;"></div>
                    </fieldset>
                </fieldset>

            <?php }
            }
       ?>

    </section>
    <section class="navigation">
        <nav>
            <a href="createProject.php"><button>Create Project</button></a>
            <a href="project.php"><button>Project View</button></a>
        </nav>
    </section>
</body>
</html>