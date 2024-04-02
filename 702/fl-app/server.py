import flwr as fl
import sys

if len(sys.argv) != 3:
    print("ArgumentError - Usage: python3 <script> <server_addr> <server_port>")
    exit(127)

server_addr = sys.argv[1]
server_port = sys.argv[2]

# Start Flower server
fl.server.start_server(
  server_address="{}:{}".format(server_addr, server_port),
  config=fl.server.ServerConfig(num_rounds=3),
)