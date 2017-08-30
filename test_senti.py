import json
import urllib2

inurl = 'http://54.191.184.205:8984/solr/twoogle/select?q=*%3A*&fl=id%2Ctweet_text&wt=json&indent=true&rows=1000'
#outfn = 'path_to_your_file.txt'

#outf = open(outfn, 'a+')
data = urllib2.urlopen(inurl,'utf-8')

docs = json.load(data)['response']['docs']

sent_file = open('AFINN.txt')
#tweet_file = open(sys.argv[2])
tweet_file = docs
afinnfile = open('AFINN.txt')

scores = {} # initialize an empty dictionary
for line in afinnfile:
    term, score  = line.split("\t")
    scores[term] = int(score)

'''
#new=open(sys.argv[2])
new = docs
for line in new:
    data=json.loads(line)
    #pri(data)
    sum_e=0
    if "tweet_text" in data:
        l=data["tweet_text"]
        l2=l.encode('ascii','ignore')
        
        ter=l2.split(" ")
        #print(ter)
        for a in ter:
            #print a
            if a in scores:
                sum_e = sum_e+scores.get(a)
        print sum_e
'''        
sum_pos = 0
sum_neg = 0
sum_neut = 0

for i in range(0,len(tweet_file)):
    sum_e = 0
    if "tweet_text" in tweet_file[i]:
        l = tweet_file[i]["tweet_text"]
        l2=l[0].encode('ascii','ignore')
        
        ter=l2.split(" ")
        #print(ter)
        for a in ter:
            #print a
            if a in scores:
                sum_e = sum_e+scores.get(a)
        if (sum_e > 0):
            sum_pos += 1
        else:
            if(sum_e < 0):
                sum_neg +=1
            else:
                sum_neut +=1
            
print "sum of positive: %d " %sum_pos
print "sum of negative: %d " %sum_neg
print "sum of neutral: %d" %sum_neut
     
