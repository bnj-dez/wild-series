USE wild-series;

INSERT INTO season (year, description, program_id_id)
VALUES
(2010, "Après une épidémie post-apocalyptique ayant transformé la quasi-totalité de la population américaine
et mondiale en mort-vivants ou « rôdeurs », un groupe d''hommes et de femmes mené par l''adjoint du shérif du comté de
Kings (en Géorgie) USA, Rick Grimes, tente de survivre…
Ensemble, ils vont devoir tant bien que mal faire face à ce nouveau monde devenu méconnaissable,
à travers leur périple dans le Sud profond des États-Unis. ", 1),
(2011, "À la suite de l''explosion du CDC, le groupe de survivants mené par Rick Grimes arrive à la ferme des Greene
pour survivre aux rôdeurs. ", 1),
(2012, "Après avoir été contraint de quitter en hâte la ferme de Hershel sous l''assaut des rôdeurs, le petit groupe
erre péniblement dans un monde de plus en plus chaotique et dangereux, tandis que la grossesse de Lori arrive bientôt
à son terme. Par hasard, Rick découvre un endroit potentiellement sûr : une prison. Lui et les siens décident alors d'y
prendre leurs quartiers. De son côté, Andrea, qui a été laissée pour morte par le groupe après l''incendie de la ferme,
s'est fait une nouvelle amie en la personne de Michonne.", 1),
(2018, "Lors de l''été 1992, Hugh et Olivia Crain s''installent temporairement dans un ancien manoir, Hill House, avec
leurs cinq enfants : Steven, Shirley, Theodora, Luke et Eleanor. Mais d''étranges événements commencent à se dérouler
au sein du manoir et affectent principalement Olivia dont le comportement devient de plus en plus étrange. ", 2);


INSERT INTO episode (title, number, synopsis, season_id_id)
VALUES
('Days Gone Bye', 1,
"Deputy Sheriff Rick Grimes awakens from a coma, and searches for his family in a world
 ravaged by the undead.", 1),
 ('Guts', 2,
"In Atlanta, Rick is rescued by a group of survivors, but they soon find themselves trapped inside a department
store surrounded by walkers.", 1),
('Tell It to the Frogs', 3,
"Rick is reunited with Lori and Carl but soon decides - along with some of the other survivors - to return to the
rooftop and rescue Merle. Meanwhile, tensions run high between the other survivors at the camp.", 1),
 ('Vatos', 4,
"Rick, Glenn, Daryl and T-Dog come across a group of seemingly hostile survivors whilst searching for Merle. Back at
camp, Jim begins behaving erratically.", 1),
('Wildfire', 5,
"After the attack on the camp, Rick leads the survivors to the C.D.C., in the hope that they can cure an infected
Jim.", 1),
 ('TS-19', 6,
"The survivors gain access to the C.D.C. in the hope of a safe haven.", 1),
('Steven Sees a Ghost', 1,
"While investigating a ghost story for his latest novel, a skeptical Steven receives a call from his sister that
triggers a chain of fateful events.", 2),
 ('Open Casket', 2,
"A devastating family tragedy stirs memories of traumatic losses, reminding Shirley of her first brush with death --
and awakening long-dormant fears.", 2),
('Touch', 3,
"Keenly perceptive Theo sees shades of herself in a troubled young patient, a girl who''s haunted by the menacing
grin of 'Mr. Smiley.'", 2),
 ('The Twin Thing', 4,
"Still wrestling with addiction -- and an unshakable fright -- a frantic Luke tries to save a friend while sensing his
twin sister is in danger.", 2);