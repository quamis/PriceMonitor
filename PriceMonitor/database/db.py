import mysql.connector

class db(object):
    def __init__(self, username, password, database='exchangerate', host='localhost'):
        self.username = username
        self.password = password
        self.database = database
        self.host = host
        self.connection = None
        self.connect()
        
    def connect(self):
        self.connection = mysql.connector.connect(user=self.username, password=self.password, database=self.database, host=self.host)
        
    def insert(self, query, bindParams):
        cursor = self.connection.cursor()
        cursor.execute(query, bindParams)
        cursor.close()

    def commit(self):
        self.connection.commit()
        
    def insertAndGetId(self, query, bindParams):
        cursor = self.connection.cursor()
        cursor.execute(query, bindParams)
        insertId = cursor.lastrowid
        self.connection.commit()
        cursor.close()
        return insertId

    def getQueryCursor(self, query, params=[]):
        cursor = self.connection.cursor()
        cursor.execute(query, params)
        return cursor
        
    def closeQueryCursor(self, cursor):
        cursor.close()
        
        
    def getCol(self, query, params=[]):
        cursor = self.getQueryCursor(query, params)
        ret = []
        for v in cursor:
            ret.append(v[0])
        self.closeQueryCursor(cursor)
        return ret
        
    def getAll(self, query, params=[], keys=[]):
        #cursor = self.connection.cursor(dictionary=True)
        #cursor.execute(query, params)
        #ret = []
        #for v in cursor:
        #    ret.append(v)
        #self.closeQueryCursor(cursor)
        
        cursor = self.getQueryCursor(query, params)
        ret = []
        for values in cursor:
            ret.append(dict(zip(keys, values)))
        self.closeQueryCursor(cursor)
        
        return ret
    
    def execute(self, query, params=[]):
        cursor = self.getQueryCursor(query, params)
        self.closeQueryCursor(cursor)
