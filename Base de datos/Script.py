# Autor: Arriaga Martinez Alan Eduardo
# mysqldump -u username -p database_name > data-dump.sql

import csv
import pymysql

###########################################################################
DB_name = "SAES"
password = ""
user = "root"
db = pymysql.connect("localhost", user, password, DB_name)
###########################################################################

def comit(sql):
	try:
		cursor.execute(sql)
		db.commit()
	except:
		db.rollback()

def getClaveMateria(nombre):
	sql = "SELECT * FROM `Materia` WHERE Nombre='"+nombre+"'"
	cursor.execute(sql)
	row = cursor.fetchone()
	if row != None: 
		return row[0]
	else:
		print("ERROR: Clave de " + nombre + " no encontrada.")
		exit(1)

def getDia(i):
    if i == 5:		return "Lun"
    elif i == 6:	return "Mar"
    elif i == 7:	return "Mie"
    elif i == 8:	return "Jue"
    elif i == 9:	return "Vie"
    else:			return "Sab"

def insertarAlumno(row):
	comit("INSERT INTO `Alumno` (`Boleta`, `Nombre`) VALUES ('"+row[0]+"', '"+row[1]+"');")

def insertarMateria(row):
	sql = "INSERT INTO `Materia` (`Periodo`, `Clave`, `Nombre`, `Tipo`, `Creditos`) "
	sql += "VALUES ('"+row[0]+"', '"+row[1]+"', '"+row[2]+"', '"+row[3]+"', '"+row[4]+"');"
	comit(sql)

def insertarGrupo(row):
	sql = "INSERT INTO `Grupo` (`Grupo`, `Materia_Clave`, `Profesor`, `Turno`, `Ocupabilidad`) "
	sql += "VALUES ('"+row[0]+"', '"+getClaveMateria(row[1])+"', '"+row[2]+"', '"+row[0][2]+"', 30);"
	comit(sql)
	insertarClases(row)

def insertarClases(row):
	for i in range(5, 10):
		if row[i] != '':
			sql = "INSERT INTO `Clases` (`Grupo`, `Materia_Clave`, `Dia`, `Hora`) "
			sql += "VALUES ('"+row[0]+"', '"+getClaveMateria(row[1])+"', '"+getDia(i)+"', '"+row[i]+"');"
			comit(sql)

def insertar(opc, row):
	if opc == 0:	insertarAlumno(row)
	if opc == 1:	insertarMateria(row)
	if opc == 2:	insertarGrupo(row)

def leerArchivo(nombre, opc):
	campos = True
	with open(nombre + '.csv', newline='', errors='ignore') as File:  
		reader = csv.reader(File)
		for row in reader:
			if campos == True:
				campos = False
			else:
				insertar(opc, row)
	
cursor = db.cursor()
leerArchivo('SAES-Alumnos', 0)
leerArchivo('SAES-Materias', 1)
leerArchivo('SAES-Horarios', 2)
db.close()
print("\n\tLos datos de agregaron a la base correctamente.\n")