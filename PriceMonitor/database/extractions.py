class extractions(object):
    def __init__(self, db):
        self.db = db
        
    def insert(self, bank, optype, currency, value, time):
        return self.db.insert("INSERT INTO `extractions` (`bank`, `type`, `currency`, `value`, `time`) VALUES (%s, %s, %s, %s, %s)", (bank, optype, currency, value, time))
        
    def commit(self):
        self.db.commit()
        
    def getQueryCursor(self, query, params=[]):
        self.db.getQueryCursor(query, params)
