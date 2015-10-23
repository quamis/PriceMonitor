class bankLogs(object):
    def __init__(self, db):
        self.db = db
        
    def insert(self, bank, status, time):
        return self.db.insert("INSERT INTO `bankLogs` (`bank`, `status`, `time`) VALUES (%s, %s, %s)", (bank, status, time))
        
    def commit(self):
        self.db.commit()
        