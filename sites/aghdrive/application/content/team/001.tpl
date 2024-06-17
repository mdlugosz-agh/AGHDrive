{$user_name_surname="Paweł Skruch" scope=root} 

{if $type=='full'}

{block name="header"}
    {$user_name_surname}
{/block}

{block name="body"}
<p class="w3-justify">
    <img src="/img/team/pawel-skruch.png" class="w3-margin-right" 
        alt="Paweł Skruch" title="Paweł Skruch" 
        style="max-width:300px;float:left;"/>
    Pawel Skruch received the M.S. degree with honors in automation control from the Faculty of Electrical Engineering, Automatics, Computer Science and Electronics of the AGH University of Science and Technology in Krakow, Poland, in 2001 and the Ph.D. degree (summa cum laude) from the same university in 2005. He received his D.Sc. (Habilitation) degree in Automatics and Robotics from the AGH University in 2016. Since 2007 he has been Assistant Professor in Department of Automatics and Biomedical Engineering at the AGH University of Science and Technology in Krakow and a member of Dynamical Systems and Control Theory Team that is led by Prof. Wojciech Mitkowski. Since 2001 he has been also working at Delphi Technical Center Krakow in Electronics & Safety division where currently he is leading an R&D group for Active Safety, Advanced Driver Assistance and Automated Driving systems. In 2014, he together with Dr. Marek Dlugosz founded AGH University-Delphi laboratory for autonomous vehicle driving. Since 2014 he has been also one of the mentors of the student’s research circle INTEGRA. He is also co-founder of INCOSE Polish Chapter Foundation and a member of INCOSE organization. He is authored and co-authored of 2 monographs and more than 80 research papers (11 book chapters, 26 journals papers, 52 conference proceedings). He supervised 23 Master theses and 21 Bachelor theses. His current research is in the areas of dynamical systems, autonomous systems, modeling and simulation and applications of control theory to software systems.
</p>
{/block}

{else if $type=='short'}

<div class="w3-card-4 test" style="width:92%;max-width:300px;">
    <img src="/img/team/pawel-skruch.png" alt="Paweł Skruch" title="Paweł Skruch" style="width:100%;opacity:0.85">
    <div class="w3-container">
        <h4><b>Paweł Skruch</b></h4>    
        <p>Architect and engineer</p>    
    </div>
</div>

{/if}