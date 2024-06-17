{$user_name_surname="Marek Długosz" scope=root} 

{if $type=='full'}

{block name="header"}
    {$user_name_surname}
{/block}

{block name="body"}
<p class="w3-justify">
    <img src="/img/team/mdl-foto.png" class="w3-margin-right" 
        alt="{$user_name_surname}" title="{$user_name_surname}" 
        style="max-width:300px;float:left;"/>
        Dr. Eng. Marek Długosz is a graduate and faculty member of the Faculty of Electrical Engineering, Automatics, Computer Science and Biomedical Engineering at the AGH University of Science and Technology in Krakow, where he obtained a PhD in technical sciences in the discipline of automation and robotics. Dr. Eng. Marek Długosz is the author or co-author of over 80 publications, including articles, book chapters, and monographs. These works have been frequently cited in the global literature (Hirsch index: WoS – 4, Scopus – 6, Google Scholar – 8). He is a Senior Member of IEEE and the chairman of the Board of the Polish Chapter of IEEE VTS. He is a laureate of the Top 500 Innovators programme, under which he completed a "Design Thinking" course at Stanford University in Palo Alto and conducted a research internship at NASA laboratories in Mountain View. He is the scientific supervisor of the Integra Scientific Circle, for which he has been repeatedly awarded by the Rector of AGH. In 2023, he received the Minister of Education and Science award for chairing KN Integra and for outstanding scientific achievements. His scientific interests focus on complex control algorithms, particularly in relation to electric drives, temperature control in buildings, and, in recent years, the design and control of autonomous vehicles and robots. Together with a team of students, he designed and built three autonomous robot constructions. ADR, AQUILO, and UV-BOT. He is the head of the Aptiv-AGH Artificial Intelligence and Autonomous Vehicles Laboratory, where research and work are conducted on the prototype design of a demonstrative autonomous and electric vehicle named A-EVE (Autonomous Electrical Vehicle). 
        In his spare time, his hobbies include gliding, swimming, skiing, and reading books.
</p>
{/block}

{else if $type=='short'}

<div class="w3-card-4 test" style="width:92%;max-width:300px;">
    <img src="/img/team/mdl-foto.png" alt="{$user_name_surname}" title="{$user_name_surname}" style="width:100%;opacity:0.85">
    <div class="w3-container">
    <h4><b>Marek Długosz</b></h4>    
    <p>Architect and engineer</p>    
    </div>
</div>

{/if}