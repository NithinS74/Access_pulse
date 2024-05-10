int lock = D0;
void setup()
{
  pinMode(lock,OUTPUT);
  digitalWrite(lock, LOW);
}
void loop()
{
  digitalWrite(lock, HIGH);
  delay(3000);
  digitalWrite(lock, LOW);
  delay(3000);
}