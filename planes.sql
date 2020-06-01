CREATE TABLE planes (
	pk    INTEGER PRIMARY KEY,
	make  TEXT NOT NULL,
	n     TEXT NOT NULL,
	fuel  REAL
);
INSERT INTO planes VALUES(1,'C-120','N1767V');

CREATE TABLE v(
	plane_pk INTEGER NOT NULL,
	vtype_pk INTEGER NOT NULL,
	knots INTEGER,
	vertspeed INTEGER,
	burnrate INTEGER
);
CONSTRAINT v_pk (vtype_pk, plane_pk);

INSERT INTO v VALUES(1,1,72,500,5.0);
INSERT INTO v VALUES(1,2,60,400,5.0);
INSERT INTO v VALUES(1,8,105,500,4.2);
INSERT INTO v VALUES(1,9,90,0,4.8);
INSERT INTO v VALUES(1,3,49,0,0);
INSERT INTO v VALUES(1,4,41,0,0);

CREATE TABLE vtypes(
	id TEXT NOT NULL PRIMARY KEY,
	description TEXT
);
INSERT INTO vtypes VALUES('Y','Best Rate of Climb');
INSERT INTO vtypes VALUES('X','Best Angle of Climb');
INSERT INTO vtypes VALUES('S0','');
INSERT INTO vtypes VALUES('S1','');
INSERT INTO vtypes VALUES('A','');
INSERT INTO vtypes VALUES('M','');
INSERT INTO vtypes VALUES('S2','');
INSERT INTO vtypes VALUES('D','Descent Speed');
INSERT INTO vtypes VALUES('C','Cruise Speed');

